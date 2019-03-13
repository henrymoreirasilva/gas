<?php

namespace Gas\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Gas\Repositories\BranchRepository;
use Gas\Models\Branch;
use Gas\Validators\BranchValidator;

/**
 * Class BranchRepositoryEloquent.
 *
 * @package namespace Gas\Repositories;
 */
class BranchRepositoryEloquent extends BaseRepository implements BranchRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Branch::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
