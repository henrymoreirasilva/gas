<?php

namespace Gas\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Gas\Repositories\ProductRepository;
use Gas\Models\Product;
use Gas\Validators\ProductValidator;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace Gas\Repositories;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    public function getProductsNameWith($expression, $columns) {
        $products = $this->findWhere([['name', 'like', "%$expression%"]], $columns);
        
        return $products;
    }
    
    public function lists($column, $key = null) {
        return $this->model->lists($column, $key);
    }

}
