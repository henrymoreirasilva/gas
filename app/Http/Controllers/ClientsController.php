<?php

namespace Gas\Http\Controllers;

use Illuminate\Http\Request;

use Gas\Http\Requests;
use Gas\Http\Controllers\Controller;
use Gas\Repositories\ClientRepository;
use Gas\Http\Requests\AdminClientRequest;
use Gas\Repositories\BranchRepository;

class ClientsController extends Controller
{
    private $repository;
    private $branchRepository;
    
    public function __construct(ClientRepository $repository, BranchRepository $branchRepository) {
        $this->repository = $repository;
        $this->branchRepository = $branchRepository;
    }
    
    public function index() {
        $clients = $this->repository->paginate(10);
        
        return view('admin.clients.index', compact('clients'));
    }
    
    public function show($id) {
        $client = $this->repository->find($id);
        return $client;
    }
    
    public function create() {
        $branches = $this->branchRepository->lists('company_name', 'id');
        return view('admin.clients.create', compact('branches'));
    }
    
    public function store(AdminClientRequest $request) {
        $data = $request->all();

        $this->repository->create($data);
        
        return redirect()->route('admin.clients.index');
    }
    
    public function edit($id) {
        $client = $this->repository->find($id);
        $branches = $this->branchRepository->lists('company_name', 'id');
        $branches->prepend('***', '');
        return view('admin.clients.edit', compact('client', 'branches'));
    }
    
    public function update(AdminClientRequest $request, $id) {
        $data = $request->all();
        if (!$data['branch_id']) {
            $data['branch_id'] = NULL;
        }
        $this->repository->update($data, $id);
        
        return redirect()->route('admin.clients.index');
    }
    
    public function lista($exp = '') {
        if (empty($exp)) {
            $clients = $this->repository->paginate(10);
        } else {
            $clients = \Gas\Models\Client::where('name', 'LIKE', '%'.$exp.'%')
            ->orWhere('company_name', 'LIKE', '%'.$exp.'%')
            ->orWhere('email', 'LIKE', '%'.$exp.'%')
            ->orWhere('phone', 'LIKE', '%'.$exp.'%')
            ->orWhere('document', 'LIKE', '%'.$exp.'%')->paginate(10);
            $clients->appends(array('exp' => $data['exp']));
        }
        
        return view('admin.clients.pesquisa', ['exp' => $exp, 'clients' => $clients]);
    }
    
    public function pesquisa(Request $request) {
        $data = $request->all();
        
        $clients = \Gas\Models\Client::where('name', 'LIKE', '%'.$data['exp'].'%')
        ->orWhere('company_name', 'LIKE', '%'.$data['exp'].'%')
        ->orWhere('email', 'LIKE', '%'.$data['exp'].'%')
        ->orWhere('phone', 'LIKE', '%'.$data['exp'].'%')
        ->orWhere('document', 'LIKE', '%'.$data['exp'].'%')->paginate(10);
        $clients->appends(array('exp' => $data['exp']));
        
        return view('admin.clients.pesquisa', ['clients' => $clients, 'exp' => $data['exp']]);
    }
}
