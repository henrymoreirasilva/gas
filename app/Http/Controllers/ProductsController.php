<?php

namespace Gas\Http\Controllers;

use Illuminate\Http\Request;

use Gas\Http\Requests;
use Gas\Http\Controllers\Controller;
use Gas\Repositories\ProductRepository;

class ProductsController extends Controller
{
    public function index(ProductRepository $repository) {
        $products = $repository->paginate(10);
        
        return view('admin.products.index', compact('products'));
    }
}
