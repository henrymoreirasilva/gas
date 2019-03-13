<?php

namespace Gas\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Gas\Repositories\SaleItemRepository;
use Gas\Models\SaleItem;
use Gas\Validators\SaleItemValidator;

/**
 * Class SaleItemRepositoryEloquent.
 *
 * @package namespace Gas\Repositories;
 */
class SaleItemRepositoryEloquent extends BaseRepository implements SaleItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SaleItem::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
