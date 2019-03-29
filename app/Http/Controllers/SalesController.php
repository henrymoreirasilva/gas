<?php

namespace Gas\Http\Controllers;

use Illuminate\Http\Request;

use Gas\Http\Requests;
use Gas\Http\Controllers\Controller;
use Gas\Repositories\SaleRepository;
use Gas\Repositories\ClientRepository;
use Gas\Repositories\BranchRepository;
use Gas\Http\Requests\AdminSaleRequest;
use Gas\Repositories\SellerRepository;

class SalesController extends Controller
{
    private $repository;
    private $branchRepository;
    private $clientRepository;
    private $sellerRepository;
    
    public function __construct(SaleRepository $repository, ClientRepository $clientRepository, BranchRepository $branchRepository, SellerRepository $sellerRepository) {
        $this->repository = $repository;
        $this->branchRepository = $branchRepository;
        $this->clientRepository = $clientRepository;
        $this->sellerRepository = $sellerRepository;
    }
    
    public function index() {
        $sales = $this->repository->paginate(10);
        
        return view('admin.sales.index', compact('sales'));
    }
    
    public function create() {
        $branches = $this->branchRepository->lists('company_name', 'id');
        $branches->prepend('***', '');
        $clients = $this->clientRepository->lists('name', 'id');
        $clients->prepend('***', '');
        $sellers = $this->sellerRepository->lists('name', 'id');
        $sellers->prepend('***', '');
        return view('admin.sales.create', compact('branches', 'clients', 'sellers'));
    }
    
    public function store(AdminSaleRequest $request) {
        $data = $request->all();
        
        $data['amount'] = $this->tiraMaskPreco($data['amount']);
        
        $this->repository->create($data);
        
        return redirect()->route('admin.sales.index');
    }
    
    public function edit($id) {
        $sale = $this->repository->find($id);
        
        $branches = $this->branchRepository->lists('company_name', 'id');
        $branches->prepend('***', '');
        $clients = $this->clientRepository->lists('name', 'id');
        $clients->prepend('***', '');
        $sellers = $this->sellerRepository->lists('name', 'id');
        $sellers->prepend('***', '');
        
        return view('admin.sales.edit', compact('sale', 'branches', 'clients', 'sellers'));
    }
    
    public function update(AdminSaleRequest $request, $id) {
        $data = $request->all();

        $data['amount'] = $this->tiraMaskPreco($data['amount']);
        
        $this->repository->update($data, $id);
        
        return redirect()->route('admin.sales.index');
    }
    
    public function tiraMaskPreco($p) {
        $p = str_replace('.', '', $p);
        $p = str_replace(',', '.', $p);
        return $p;
    }
}
