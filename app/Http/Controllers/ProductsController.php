<?php

namespace Gas\Http\Controllers;

use Illuminate\Http\Request;

use Gas\Http\Requests;
use Gas\Http\Controllers\Controller;
use Gas\Repositories\ProductRepository;
use Gas\Http\Requests\AdminProductRequest;

class ProductsController extends Controller
{
    private $repository;
    
    public function __construct(ProductRepository $repository) {
        $this->repository = $repository;
    }
    
    public function index() {
        $products = $this->repository->paginate(10);
        
        return view('admin.products.index', compact('products'));
    }
    
    public function create() {
        return view('admin.products.create');
    }
    
    public function store(AdminProductRequest $request) {
        $data = $request->all();
   
        $data['sale_price'] = $this->tiraMaskPreco($data['sale_price']);
        $data['cost_price'] = $this->tiraMaskPreco($data['cost_price']);
        
        $this->repository->create($data);
        
        return redirect()->route('admin.products.index');
    }
    
    public function edit($id) {
        $product = $this->repository->find($id);
        return view('admin.products.edit', compact('product'));
    }
    
    public function update(AdminProductRequest $request, $id) {
        $data = $request->all();
        
        $data['sale_price'] = $this->tiraMaskPreco($data['sale_price']);
        $data['cost_price'] = $this->tiraMaskPreco($data['cost_price']);

        $this->repository->update($data, $id);
        
        return redirect()->route('admin.products.index');
    }
    
    public function getProducts($expression) {
        $products =  $this->repository->getProductsNameWith($expression, ['name','id']);
        $autocomplete = array();
        foreach ($products as $p) {
            $autocomplete[] = ['id' => "{$p['id']}", 'label' => "{$p['name']}", 'value' => "{$p['name']}"];
        }
        return ($autocomplete);
    }
    
    public function tiraMaskPreco($p) {
        $p = str_replace('.', '', $p);
        $p = str_replace(',', '.', $p);
        return $p;
    }
}
