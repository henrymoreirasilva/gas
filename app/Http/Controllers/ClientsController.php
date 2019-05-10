<?php

namespace Gas\Http\Controllers;

use Illuminate\Http\Request;

use Gas\Http\Requests;
use Gas\Http\Controllers\Controller;
use Gas\Repositories\ClientRepository;
use Gas\Http\Requests\AdminClientRequest;
use Gas\Repositories\BranchRepository;
use DB;

class ClientsController extends Controller
{
    private $repository;
    private $branchRepository;
    
    public function __construct(ClientRepository $repository, BranchRepository $branchRepository) {
        $this->repository = $repository;
        $this->branchRepository = $branchRepository;
    }
    
    /*public function index() {
        $clients = $this->repository->paginate(10);
        
        return view('admin.clients.index', compact('clients'));
    }*/
    
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
    
    
    public function index(Request $request) {
        $data = $request->all();
        //dd($data);
        if (!isset($data['branch_id'])) {
            $data['branch_id'] = NULL;
        }
        if (!isset($data['exp'])) {
            $data['exp'] = '';
        }
        if (!isset($data['ordenacao'])) {
            $data['ordenacao'] = 'Venda';
        }
        
        $sort = 'clients.id';
        switch ($data['ordenacao']) {
            case 'Cliente': $sort = 'clients.name';break;
            case 'Cliente2': $sort = 'clients.company_name';break;
            case 'Filial': $sort = 'branches.company_name';break;
            case 'city': $sort = 'clients.city';break;
        }
        
        
        if (empty($data['exp']) and empty($data['branch_id'])) {
            $clients = DB::table('clients')
                    ->select(
                            'clients.*', 'branches.company_name as branch_name'
                            )
                    ->join('branches', function ($join) use ($data) {
                        $join->on('clients.branch_id', '=', 'branches.id');
                    })
                    ->orderBy($sort, 'asc')
                    ->paginate(10);
        } else {
            $clients = DB::table('clients')
                    ->select(
                            'clients.*', 'branches.company_name as branch_name'
                            )
                    ->join('branches', function ($join) use ($data) {
                        $join->on('clients.branch_id', '=', 'branches.id');
                    })
                    ->where(function ($query) use ($data) {
                        if (!empty($data['exp'])) {
                            $query->where('clients.name', 'LIKE', '%' . $data['exp'] . '%')
                            ->orWhere('clients.company_name', 'LIKE', '%' . $data['exp'] . '%')
                            ->orWhere('clients.email', 'LIKE', '%' . $data['exp'] . '%')
                            ->orWhere('clients.phone', 'LIKE', '%' . $data['exp'] . '%')
                            ->orWhere('clients.city', 'LIKE', '%' . $data['exp'] . '%')
                            ->orWhere('branches.company_name', 'LIKE', '%' . $data['exp'] . '%')
                            ->orWhere('clients.id', '=', $data['exp']);
                        }
                        
                        if (!empty($data['branch_id'])) {
                            $query->where('branches.id', '=', $data['branch_id']);
                        }
                    })
                    ->orderBy($sort, 'asc')
                    ->paginate(10);
        }

        $clients->appends($data);
        
        $branches = $this->branchRepository->lists('company_name', 'id');
        $branches->prepend('***', 0);
        return view('admin.clients.index', compact('data', 'clients', 'branches'));
    }
}
