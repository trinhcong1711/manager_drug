<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RefundRepository;
use App\Entities\Refund;
use App\Validators\RefundValidator;

/**
 * Class RefundRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RefundRepositoryEloquent extends BaseRepository implements RefundRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Refund::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
