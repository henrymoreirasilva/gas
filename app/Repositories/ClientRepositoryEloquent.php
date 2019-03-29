<?php

namespace Gas\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Gas\Repositories\ClientRepository;
use Gas\Models\Client;
use Gas\Validators\ClientValidator;

/**
 * Class ClientRepositoryEloquent.
 *
 * @package namespace Gas\Repositories;
 */
class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Client::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
   
    public function lists($column, $key = null) {
        return $this->model->lists($column, $key);
    }
}
