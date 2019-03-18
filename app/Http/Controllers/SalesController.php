<?php

namespace Gas\Http\Controllers;

use Illuminate\Http\Request;

use Gas\Http\Requests;
use Gas\Http\Controllers\Controller;
use Gas\Repositories\SaleRepository;

class SalesController extends Controller
{
    public function index(SaleRepository $repository) {
        $sales = $repository->paginate(10);
        
        return view('admin.sales.index', compact('sales'));
    }
}
