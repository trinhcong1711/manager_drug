<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $guarded=[];
    protected $appends = ['prices'];
    protected function getPricesAttribute(){
        return (array)json_decode($this->price);
    }
}
