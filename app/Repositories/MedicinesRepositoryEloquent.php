<?php

namespace App\Repositories;

use App\Entities\Medicine;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MedicinesRepository;
use App\Entities\Medicines;
use App\Validators\MedicinesValidator;

/**
 * Class MedicinesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MedicinesRepositoryEloquent extends BaseRepository implements MedicinesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Medicine::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
