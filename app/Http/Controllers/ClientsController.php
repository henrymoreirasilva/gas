<?php

namespace Gas\Http\Controllers;

use Illuminate\Http\Request;

use Gas\Http\Requests;
use Gas\Http\Controllers\Controller;
use Gas\Repositories\ClientRepository;

class ClientsController extends Controller
{
    public function index(ClientRepository $repository) {
        $clients = $repository->paginate(10);
        
        return view('admin.clients.index', compact('clients'));
    }
}
