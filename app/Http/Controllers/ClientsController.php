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
    
    public function listsNameWith($expression) {
        $clients =  $this->repository->listsNameWith($expression, ['name','id']);
        $autocomplete = array();
        foreach ($clients as $p) {
            $autocomplete[] = ['id' => "{$p['id']}", 'label' => "{$p['name']}", 'value' => "{$p['name']}"];
        }
        dd($autocomplete);
        return ($autocomplete);
    }
}
