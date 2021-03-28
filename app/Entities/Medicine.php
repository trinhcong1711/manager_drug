<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $guarded = [];

    public function units()
    {
        return $this->hasMany(Unit::class)->where('status', 1);
    }

//    Lấy danh sách thuốc cần nhập thêm
    public function scopeRests($query)
    {
        return $query->where('status', 1)->where('rest', '>=', 'inventory')->orderBy("id", "desc");
    }

    public function imports()
    {
        return $this->belongsToMany(Import::class)->withPivot('price','amount', 'unit','note');
    }
}
