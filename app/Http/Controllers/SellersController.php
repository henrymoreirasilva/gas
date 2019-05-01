<?php

namespace Gas\Http\Controllers;

use Illuminate\Http\Request;

use Gas\Http\Requests;
use Gas\Http\Controllers\Controller;
use Gas\Repositories\SellerRepository;
use Gas\Repositories\BranchRepository;
use Gas\Http\Requests\AdminSellerRequest;

class SellersController extends Controller
{
    private $repository;
    private $branchRepository;
    
    public function __construct(SellerRepository $repository, BranchRepository $branchRepository) {
        $this->repository = $repository;
        $this->branchRepository = $branchRepository;
    }
    
    public function index() {
        $sellers = $this->repository->paginate(10);
        
        return view('admin.sellers.index', compact('sellers'));
    }
    
    public function show($id, $branchId = NULL) {
        if ($branchId) {
            $branch = $this->repository->findWhere([
                //Default Condition =
                'branch_id' => $branchId,
                'id' => $id
            ]);
        } else {
            $branch = $this->repository->find($id);
        }
        return $branch;
    }
    
    public function create() {
        $branches = $this->branchRepository->lists('company_name', 'id');
        return view('admin.sellers.create', compact('branches'));
    }
    
    public function store(AdminSellerRequest $request) {
        $data = $request->all();
        
        $this->repository->create($data);
        
        return redirect()->route('admin.sellers.index');
    }
    
    public function edit($id) {
        $seller = $this->repository->find($id);
        $branches = $this->branchRepository->lists('company_name', 'id');
        
        $branches->prepend('***', '');
        return view('admin.sellers.edit', compact('seller', 'branches'));
    }
    
    public function update(AdminSellerRequest $request, $id) {
        $data = $request->all();
        if (!$data['branch_id']) {
            $data['branch_id'] = NULL;
        }
        $this->repository->update($data, $id);
        
        return redirect()->route('admin.sellers.index');
    }
}
