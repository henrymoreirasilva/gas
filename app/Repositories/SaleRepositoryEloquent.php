<?php

namespace Gas\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Gas\Repositories\SaleRepository;
use Gas\Models\Sale;
use Gas\Validators\SaleValidator;

/**
 * Class SaleRepositoryEloquent.
 *
 * @package namespace Gas\Repositories;
 */
class SaleRepositoryEloquent extends BaseRepository implements SaleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Sale::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
