<?php

namespace Gas\Http\Controllers;

use Illuminate\Http\Request;

use Gas\Http\Requests;
use Gas\Http\Controllers\Controller;
use Gas\Repositories\SellerRepository;

class SellersController extends Controller
{
    public function index(SellerRepository $repository) {
        $sellers = $repository->paginate(10);
        
        return view('admin.sellers.index', compact('sellers'));
    }
}
