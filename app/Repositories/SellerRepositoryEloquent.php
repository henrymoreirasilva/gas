<?php

namespace Gas\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Gas\Repositories\SellerRepository;
use Gas\Models\Seller;
use Gas\Validators\SellerValidator;

/**
 * Class SellerRepositoryEloquent.
 *
 * @package namespace Gas\Repositories;
 */
class SellerRepositoryEloquent extends BaseRepository implements SellerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Seller::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
