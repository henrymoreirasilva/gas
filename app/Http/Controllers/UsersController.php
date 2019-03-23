<?php

namespace Gas\Http\Controllers;

use Illuminate\Http\Request;

use Gas\Http\Requests;
use Gas\Http\Controllers\Controller;
use Gas\Repositories\UserRepository;
use Gas\Repositories\BranchRepository;
use Gas\Http\Requests\AdminUserRequest;

class UsersController extends Controller
{
    private $repository;
    private $branchRepository;

    
    public function __construct(BranchRepository $branchRepository, UserRepository $repository) {
        $this->branchRepository = $branchRepository;
        $this->repository = $repository;
    }
    
    public function index() {
        $users = $this->repository->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }
    
    public function create() {
        $branches = $this->branchRepository->lists('company_name', 'id');
        return view('admin.users.create', compact('branches'));
    }
    
    public function store(AdminUserRequest $request) {
        $data = $request->all();
        
        $this->repository->create($data);
        
        return redirect()->route('admin.users.index');
    }
    
    public function edit($id) {
        $user = $this->repository->find($id);
        $branches = $this->branchRepository->lists('company_name', 'id');
        $branches->prepend('***', 0);
        return view('admin.users.edit', compact('user', 'branches'));
    }
    
    public function update(AdminUserRequest $request, $id) {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $this->repository->update($data, $id);
        
        return redirect()->route('admin.users.index');
    }
}
