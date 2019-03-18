<?php

namespace Gas\Http\Controllers;

use Illuminate\Http\Request;

use Gas\Http\Requests;
use Gas\Http\Controllers\Controller;
use Gas\Repositories\BranchRepository;

class BranchesController extends Controller
{
    public function index(BranchRepository $repository) {
        $branches = $repository->paginate(10);
        
        return view('admin.branches.index', compact('branches'));
    }
}
