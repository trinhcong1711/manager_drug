<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ExportRepository;
use App\Entities\Export;
use App\Validators\ExportValidator;

/**
 * Class ExportRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ExportRepositoryEloquent extends BaseRepository implements ExportRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Export::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
