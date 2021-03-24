<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $guarded = [];
    public function units(){
        return $this->hasMany(Unit::class)->where('status',1);
    }
}
