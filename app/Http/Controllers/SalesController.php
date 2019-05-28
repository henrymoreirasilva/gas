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
use Gas\Models\Sale;
use DB;

class SalesController extends Controller {

    private $repository;
    private $branchRepository;
    private $clientRepository;
    private $sellerRepository;
    private $productRepository;
    private $itemController;

    public function __construct(SaleRepository $repository, ClientRepository $clientRepository, BranchRepository $branchRepository, SellerRepository $sellerRepository, ProductRepository $productRepository, SalesItemsController $itemController) {
        $this->repository = $repository;
        $this->branchRepository = $branchRepository;
        $this->clientRepository = $clientRepository;
        $this->sellerRepository = $sellerRepository;
        $this->productRepository = $productRepository;
        $this->itemController = $itemController;
    }

    /* public function index() {
      $sales = $this->repository->paginate(10);
      $date1 = date('Y-m-d');
      $date2 = date('Y-m-d');
      return view('admin.sales.index', compact('sales', ['date1' => $date1, 'date2' => $date2]));
      } */

    public function create() {
        $sale = new Sale();

        return view('admin.sales.create', compact('sale'));
    }

    public function store(AdminSaleRequest $request) {

        $data = $request->all();
        $data['sale_date'] = $this->formataData($data['sale_date'], '-');
        $data['amount'] = 0;

        foreach ($data['item'] as $item) {
            $data['amount'] += ($this->tiraMaskPreco($item['price-item']) * $item['qtd-item']);
        }

        $sale = $this->repository->create($data);
        foreach ($data['item'] as $item) {
            SaleItem::create(['product_id' => $item['id-item'], 'sale_id' => $sale->id, 'price' => $this->tiraMaskPreco($item['price-item']), 'quantity' => $item['qtd-item']]);
        }
        //return redirect()->route('admin.sales.index');
        return $this->create();
    }

    public function edit($id) {
        $sale = $this->repository->find($id);
        $sale->sale_date = $this->formataData($sale->sale_date);
        $items = $sale->items;

        return view('admin.sales.edit', compact('sale', 'items'));
    }

    public function update(AdminSaleRequest $request, $id) {
        $data = $request->all();
        $data['sale_date'] = $this->formataData($data['sale_date'], '-');
        $data['amount'] = 0;

        $sale = \Gas\Models\Sale::find($id);
        $items = $sale->items;
        foreach ($items as $item) {
            SaleItem::destroy($item->id);
        }

        foreach ($data['item'] as $item) {
            $data['amount'] += ($this->tiraMaskPreco($item['price-item']) * $item['qtd-item']);
            SaleItem::create(['product_id' => $item['id-item'], 'sale_id' => $id, 'price' => $this->tiraMaskPreco($item['price-item']), 'quantity' => $item['qtd-item']]);
        }
        $this->repository->update($data, $id);

        return redirect()->route('admin.sales.index');
    }

    public function index(Request $request) {
        $data = $request->all();
        //dd($data);
        if (!isset($data['date1'])) {
            $data['date1'] = date('Y-m-') . '01';
        } else {
            $data['date1'] = $this->formataData($data['date1'], '-');
        }
        if (!isset($data['date2'])) {
            $data['date2'] = date('Y-m-') . $this->diasDesteMes();
        } else {
            $data['date2'] = $this->formataData($data['date2'], '-');
        }
        if (!isset($data['branch_id'])) {
            $data['branch_id'] = NULL;
        }
        if (!isset($data['seller_id'])) {
            $data['seller_id'] = NULL;
        }
        if (!isset($data['exp'])) {
            $data['exp'] = '';
        }
        if (!isset($data['ordenacao'])) {
            $data['ordenacao'] = 'Venda';
        }

        $sort = 'sales.id';
        switch ($data['ordenacao']) {
            case 'Cliente': $sort = 'clients.name';
                break;
            case 'Cliente2': $sort = 'clients.company_name';
                break;
            case 'Filial': $sort = 'branches.company_name';
                break;
            case 'Vendedor': $sort = 'sellers.name';
                break;
            case 'Data': $sort = 'sales.sale_date';
                break;
        }

        if (empty($data['exp']) and empty($data['branch_id']) and empty($data['seller_id'])) {
            $sales = DB::table('sales')
                    ->select(
                            'sales.*', 'branches.company_name as branch_name', 'sellers.name as seller_name', 'clients.name as client_name', 'clients.company_name as client_company_name'
                    )
                    ->whereBetween('sale_date', [$data['date1'], $data['date2']])
                    ->join('sellers', function ($join) {
                        $join->on('sales.seller_id', '=', 'sellers.id');
                    })
                    ->join('clients', function ($join) {
                        $join->on('sales.client_id', '=', 'clients.id');
                    })
                    ->join('branches', function ($join) {
                        $join->on('sales.branch_id', '=', 'branches.id');
                    })
                    ->orderBy($sort, 'asc')
                    ->paginate(10);
        } else {
            $sales = DB::table('sales')
                    ->select(
                            'sales.*', 'branches.company_name as branch_name', 'sellers.name as seller_name', 'clients.name as client_name', 'clients.company_name as client_company_name'
                    )
                    ->whereBetween('sale_date', [$data['date1'], $data['date2']])
                    ->join('sellers', function ($join) {
                        $join->on('sales.seller_id', '=', 'sellers.id');
                    })
                    ->join('clients', function ($join) {
                        $join->on('sales.client_id', '=', 'clients.id');
                    })
                    ->join('branches', function ($join) {
                        $join->on('sales.branch_id', '=', 'branches.id');
                    })
                    ->where(function ($query) use ($data) {
                        if (!empty($data['exp'])) {
                            $query->where('clients.name', 'LIKE', '%' . $data['exp'] . '%')
                            ->orWhere('clients.company_name', 'LIKE', '%' . $data['exp'] . '%')
                            ->orWhere('clients.email', 'LIKE', '%' . $data['exp'] . '%')
                            ->orWhere('clients.phone', 'LIKE', '%' . $data['exp'] . '%')
                            ->orWhere('branches.company_name', 'LIKE', '%' . $data['exp'] . '%')
                            ->orWhere('sellers.name', 'LIKE', '%' . $data['exp'] . '%')
                            ->orWhere('sales.amount', 'LIKE', '%' . $data['exp'] . '%')
                            ->orWhere('sales.sale_date', 'LIKE', '%' . $data['exp'] . '%')
                            ->orWhere('sales.id', '=', $data['exp']);
                        }

                        if (!empty($data['seller_id'])) {
                            $query->where('sellers.id', '=', $data['seller_id']);
                        }

                        if (!empty($data['branch_id'])) {
                            $query->where('branches.id', '=', $data['branch_id']);
                        }
                    }
                    )
                    ->orderBy($sort, 'asc')
                    ->paginate(10);
        }
        //dd($sales);
        $data['date1'] = $this->formataData($data['date1']);
        $data['date2'] = $this->formataData($data['date2']);

        $sales->appends($data);

        $sellers = $this->sellerRepository->lists('name', 'id');
        $sellers->prepend('***', 0);

        $branches = $this->branchRepository->lists('company_name', 'id');
        $branches->prepend('***', 0);
        return view('admin.sales.index', compact('data', 'sales', 'sellers', 'branches'));
    }

    public function tiraMaskPreco($p) {
        $p = str_replace('.', '', $p);
        $p = str_replace(',', '.', $p);
        return $p;
    }

    public function formataData($d, $s = '/') {
        if ($s == '-') {
            return substr($d, 6, 4) . '-' . substr($d, 3, 2) . '-' . substr($d, 0, 2);
        } else {
            return substr($d, 8, 2) . '/' . substr($d, 5, 2) . '/' . substr($d, 0, 4);
        }
    }

    public function diasDesteMes() {

        $mes = date('m');
        $year = date('Y');

        if ($mes == '01' or $mes == '03' or $mes == '05' or $mes == '07' or $mes == '08' or $mes == '10' or $mes == '12') {
            $dias = '31';
        } else {
            if ($mes != '02') {
                $dias = '30';
            } else {
                if ($year % 4 == 0) {
                    $dias = '29';
                } else {
                    $dias = '28';
                }
            }
        }

        return $dias;
    }

    public function destroy($id) {
        $sale = \Gas\Models\Sale::find($id);
        $sale->items()->delete();
        $sale->delete();
        return redirect()->route('admin.sales.index');
    }

    public function vendaDiaria(Request $request) {
        $items = array();
        $sales = array();
        $data = $request->all();
        if (count($data) > 0) {
            if (isset($data['date1'])) {
                $data['date1'] = $this->formataData($data['date1'], '-');
            }
            if (isset($data['date2'])) {

                $data['date2'] = $this->formataData($data['date2'], '-');
            }
            if (!isset($data['branch_id'])) {
                $data['branch_id'] = NULL;
            }

            $sales = DB::table('sales')
                    ->select(
                        DB::raw("DATE_FORMAT(sales.sale_date, '%d/%m/%Y') as sale_date"), 'branches.company_name as branch_name', 'clients.name as client_name', 'branches.id as branch_id', 'clients.id as client_id', 'sales.amount'
                        //   , 'products.name', 'products.id', DB::raw("SUM(sale_items.price) as sum_item_price"), DB::raw("SUM(sale_items.quantity) as sum_item_quantity")
                    )
                    ->whereBetween('sale_date', [$data['date1'], $data['date2']])
                    ->join('branches', function ($join) {
                        $join->on('sales.branch_id', '=', 'branches.id');
                    })
                    ->join('clients', function ($join) {
                        $join->on('sales.client_id', '=', 'clients.id');
                    })
                    ->where(function ($query) use ($data) {                      

                      if (empty($data['branch_id'])) {
                        $query->where('branches.id', '<>', 0);
                      } else {
                        $query->where('branches.id', '=', $data['branch_id']);
                      }

                    })
                    ->orderBy('sales.sale_date', 'desc')
                    ->orderBy('branches.company_name')
                    ->orderBy('branches.id')
                    ->orderBy('clients.name')
                    ->get();
                    
                    $items = $this->totaisProdutos($data);
            
            $data['date1'] = $this->formataData($data['date1']);
            $data['date2'] = $this->formataData($data['date2']);
        } else {
            $data['date1'] = date('d/m/Y');
            $data['date2'] = date('d/m/Y');
        }

        $branches = $this->branchRepository->lists('company_name', 'id');
        $branches->prepend('***', 0);
        
        return view('admin.sales.relatorios.venda-diaria-cliente', compact('data', 'sales', 'branches', 'items'));
    }
    
    public function vendaDiariaProduto(Request $request) {
        $items = array();
        $sales = array();
        $data = $request->all();
        if (count($data) > 0) {
            if (isset($data['date1'])) {
                $data['date1'] = $this->formataData($data['date1'], '-');
            }
            if (isset($data['date2'])) {

                $data['date2'] = $this->formataData($data['date2'], '-');
            }
            if (!isset($data['branch_id'])) {
                $data['branch_id'] = NULL;
            }

            $sales = DB::table('sales')
                    ->select(
                        DB::raw("DATE_FORMAT(sales.sale_date, '%d/%m/%Y') as sale_date"), 'branches.company_name as branch_name', 'products.name as product_name', 'branches.id as branch_id', 'products.id as product_id',
                        DB::raw("SUM(sale_items.quantity * sale_items.price) AS price"),
                        DB::raw("SUM(sale_items.quantity) AS quantity"),  
                        DB::raw("AVG(sale_items.price) AS price_avg")
                    )
                    ->whereBetween('sale_date', [$data['date1'], $data['date2']])
                    ->join('branches', function ($join) {
                        $join->on('sales.branch_id', '=', 'branches.id');
                    })
                    ->join('sale_items', function ($join) {
                        $join->on('sale_items.sale_id', '=', 'sales.id');
                    })
                    ->join('products', function ($join) {
                        $join->on('products.id', '=', 'sale_items.product_id');
                    })
                    ->where(function ($query) use ($data) {                      

                        if (empty($data['branch_id'])) {
                          $query->where('branches.id', '<>', 0);
                        } else {
                          $query->where('branches.id', '=', $data['branch_id']);
                        }
                    })
                    ->orderBy('sales.sale_date', 'desc')
                    ->orderBy('branches.company_name')
                    ->orderBy('branches.id')
                    ->orderBy('products.name')
                            
                    ->groupBy('sales.sale_date')
                    ->groupBy('branches.id')
                    ->groupBy('products.id')
                    ->get();
                    
            $items = $this->totaisProdutos($data);
            
            $data['date1'] = $this->formataData($data['date1']);
            $data['date2'] = $this->formataData($data['date2']);
        } else {
            $data['date1'] = date('d/m/Y');
            $data['date2'] = date('d/m/Y');
        }

        $branches = $this->branchRepository->lists('company_name', 'id');
        $branches->prepend('***', 0);
        
        return view('admin.sales.relatorios.venda-diaria-produto', compact('data', 'sales', 'branches', 'items'));
    }
    
    public function vendaClienteProduto(Request $request) {
        $items = array();
        $sales = array();
        $data = $request->all();
        if (count($data) > 0) {
            if (isset($data['date1'])) {
                $data['date1'] = $this->formataData($data['date1'], '-');
            }
            if (isset($data['date2'])) {

                $data['date2'] = $this->formataData($data['date2'], '-');
            }
            if (!isset($data['branch_id'])) {
                $data['branch_id'] = NULL;
            }
            if (!isset($data['client_id'])) {
                $data['client_id'] = NULL;
            }

            $sales = DB::table('sales')
                    ->select(
                        DB::raw("DATE_FORMAT(sales.sale_date, '%d/%m/%Y') as sale_date"), 'branches.company_name as branch_name', 'branches.id as branch_id',
                        DB::raw("SUM(sale_items.price) as sum_item_price"), DB::raw("SUM(sale_items.quantity) as sum_item_quantity"),
                        DB::raw("AVG(sale_items.price) as avg_item_price"), 'products.name as product_name', 'products.unidade', 'products.id as product_id',
                        DB::raw("SUM(sale_items.price * sale_items.quantity) as sum_total"), 'clients.name as client_name', 'clients.company_name as client_company_name',
                        'clients.id as client_id'
                    )
                    ->join('branches', function ($join) {
                        $join->on('sales.branch_id', '=', 'branches.id');
                    })
                    ->join('clients', function ($join) {
                        $join->on('sales.client_id', '=', 'clients.id');
                    })
                    ->join('sale_items', function ($join) {
                        $join->on('sale_items.sale_id', '=', 'sales.id');
                    })
                    ->join('products', function ($join) {
                        $join->on('products.id', '=', 'sale_items.product_id');
                    })
                    ->whereBetween('sale_date', [$data['date1'], $data['date2']])
                    ->where(function ($query) use ($data) {                      

                        if (empty($data['branch_id'])) {
                          $query->where('branches.id', '<>', 0);
                        } else {
                          $query->where('branches.id', '=', $data['branch_id']);
                        }
                        
                        if (empty($data['client_id'])) {
                          $query->where('clients.id', '<>', 0);
                        } else {
                          $query->where('clients.id', '=', $data['client_id']);
                        }
                    })
                    ->orderBy('branches.company_name')
                    ->orderBy('branches.id')
                    ->orderBy('clients.name')
                    ->orderBy('clients.id')
                    ->orderBy('sales.sale_date', 'desc')
                    ->orderBy('products.name')

                    ->groupBy('branches.id')
                    ->groupBy('clients.id')
                    ->groupBy('sales.sale_date')
                    ->get();
                    
            $items = $this->totaisProdutos($data);
            
            $data['date1'] = $this->formataData($data['date1']);
            $data['date2'] = $this->formataData($data['date2']);
        } else {
            $data['date1'] = date('d/m/Y');
            $data['date2'] = date('d/m/Y');
        }

        $branches = $this->branchRepository->lists('company_name', 'id');
        $branches->prepend('***', 0);
        
        $clients = $this->clientRepository->lists('name', 'id');
        $clients->prepend('***', 0);
        
        return view('admin.sales.relatorios.venda-diaria-cliente-produto', compact('data', 'sales', 'branches', 'items', 'clients'));
    }
    
    public function totaisProdutos($data) {
        $items = array();
        if (count($data) > 0) {
            $items = DB::table('sale_items')
                    ->select(
                        DB::raw("SUM(sale_items.price) as sum_item_price"), DB::raw("SUM(sale_items.quantity) as sum_item_quantity"),
                        DB::raw("AVG(sale_items.price) as avg_item_price"), 'products.name', 'products.unidade',
                        DB::raw("SUM(sale_items.price * sale_items.quantity) as sum_total")
                    )
                    ->join('sales', function ($join) {
                        $join->on('sales.id', '=', 'sale_items.sale_id');
                    })
                    ->join('branches', function ($join) {
                        $join->on('sales.branch_id', '=', 'branches.id');
                    })
                    ->join('products', function ($join) {
                        $join->on('sale_items.product_id', '=', 'products.id');
                    })
                    ->join('clients', function ($join) {
                        $join->on('sales.client_id', '=', 'clients.id');
                    })
                    ->whereBetween('sale_date', [$data['date1'], $data['date2']])
                    ->where(function ($query) use ($data) {                      

                        if (empty($data['branch_id'])) {
                          $query->where('branches.id', '<>', 0);
                        } else {
                          $query->where('branches.id', '=', $data['branch_id']);
                        }

                        if (empty($data['client_id'])) {
                          $query->where('clients.id', '<>', 0);
                        } else {
                          $query->where('clients.id', '=', $data['client_id']);
                        }

                    })
                    ->orderBy('products.name')
                    ->orderBy('products.id')
                    ->groupBy('products.id')
                    ->get();
                    
        }
        
        return $items;
    }
    
    
}
