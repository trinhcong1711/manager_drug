<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Import.
 *
 * @package namespace App\Entities;
 */
class Import extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["user_id", "note", "checked_at"];

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class)->withPivot('price','amount', 'unit','note');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
