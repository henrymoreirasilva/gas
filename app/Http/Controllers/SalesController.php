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
use Gas\Repositories\ProductRepository;
use Gas\Models\SaleItem;
use Gas\Repositories\SaleItemRepository;

class SalesController extends Controller
{
    private $repository;
    private $branchRepository;
    private $clientRepository;
    private $sellerRepository;
    private $productRepository;
    private $itemController;
    
    public function __construct(SaleRepository $repository, ClientRepository $clientRepository, BranchRepository $branchRepository, SellerRepository $sellerRepository,
        ProductRepository $productRepository, SalesItemsController $itemController) {
        $this->repository = $repository;
        $this->branchRepository = $branchRepository;
        $this->clientRepository = $clientRepository;
        $this->sellerRepository = $sellerRepository;
        $this->productRepository = $productRepository;
        $this->itemController = $itemController;
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
        $products = $this->productRepository->orderBy('name')->all();
        return view('admin.sales.create', compact('branches', 'clients', 'sellers', 'products'));
    }
    
    public function store(AdminSaleRequest $request) {

        $data = $request->all();
        $data['sale_date'] = $this->formataData($data['sale_date'], '-');
        $data['amount'] = 0;

        foreach($data['item'] as $item) {
            $data['amount'] += ($this->tiraMaskPreco($item['price-item']) * $item['qtd-item']);
        }
        
        $sale = $this->repository->create($data);
        foreach($data['item'] as $item) {
            SaleItem::create(['product_id' => $item['id-item'], 'sale_id' => $sale->id, 'price' => $this->tiraMaskPreco($item['price-item']), 'quantity' => $item['qtd-item']]);
        }
        return redirect()->route('admin.sales.index');
    }
    
    public function edit($id) {
        $sale = $this->repository->find($id);
        $sale->sale_date = $this->formataData($sale->sale_date);
        $items = $sale->items;
        
        $branches = $this->branchRepository->lists('company_name', 'id');
        $branches->prepend('***', '');
        $clients = $this->clientRepository->lists('name', 'id');
        $clients->prepend('***', '');
        $sellers = $this->sellerRepository->lists('name', 'id');
        $sellers->prepend('***', '');
        $products = $this->productRepository->orderBy('name')->all();
        return view('admin.sales.edit', compact('sale', 'branches', 'clients', 'sellers', 'products', 'items'));
    }
    
    public function update(AdminSaleRequest $request, $id) {
        $data = $request->all();
        $data['sale_date'] = $this->formataData($data['sale_date'], '-');
        $data['amount'] = 0;
        
        $sale = \Gas\Models\Sale::find($id);
        $items = $sale->items;
        foreach($items as $item) {
            SaleItem::destroy($item->id);
        }

        foreach($data['item'] as $item) {
            $data['amount'] += ($this->tiraMaskPreco($item['price-item']) * $item['qtd-item']);
            SaleItem::create(['product_id' => $item['id-item'], 'sale_id' => $id, 'price' => $this->tiraMaskPreco($item['price-item']), 'quantity' => $item['qtd-item']]);
        }
        $this->repository->update($data, $id);
        
        return redirect()->route('admin.sales.index');
    }
    
    public function tiraMaskPreco($p) {
        $p = str_replace('.', '', $p);
        $p = str_replace(',', '.', $p);
        return $p;
    }
    
    public function formataData($d, $s = '/') {
        if ($s == '-') {
            return substr($d, 6, 4). '-'. substr($d, 3, 2) . '-'. substr($d, 0, 2);
        } else {
            return substr($d, 8, 2) . '/'. substr($d, 5, 2). '/'. substr($d, 0, 4);
        }
    }
}
