<?php

namespace Gas\Http\Controllers;

use Illuminate\Http\Request;

use Gas\Http\Requests;
use Gas\Http\Controllers\Controller;
use Gas\Repositories\BranchRepository;
use Gas\Http\Requests\AdminBrancheRequest;

class BranchesController extends Controller
{
    private $repository;
    public function __construct(BranchRepository $repository) {
        $this->repository = $repository;
    }
    
    public function index() {
        $branches = $this->repository->paginate(10);
        
        return view('admin.branches.index', compact('branches'));
    }
    
    public function create() {       
        return view('admin.branches.create');
    }
    
    public function store(AdminBrancheRequest $request) {
        $data = $request->all();
        
        $this->repository->create($data);
        
        return redirect()->route('admin.branches.index');
    }
}
