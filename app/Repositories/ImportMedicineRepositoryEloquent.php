<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ImportMedicineRepository;
use App\Entities\ImportMedicine;
use App\Validators\ImportMedicineValidator;

/**
 * Class ImportMedicineRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ImportMedicineRepositoryEloquent extends BaseRepository implements ImportMedicineRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ImportMedicine::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
