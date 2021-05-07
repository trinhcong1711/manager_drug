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
    public function formatPrice($prices)
    {
        if ($prices) {
            $html = '';
            if (count($prices) > 0 && !empty($prices)) {
                $html = '<table>';
                foreach ($prices as $k => $price) {
                    $html .= '<tr>
                            <td class="border-top-0 p-0">' . number_format($price->convert,0,"",",") . ' </td>
                            <td class="border-top-0 p-0 pr-1 text-capitalize">' . $price->name . ':</td>
                            <td class="border-top-0 p-0">' . number_format($price->price,0,"",",") . '</td>
                        </tr>';
                }
                $html .= '</table>';
            }
            return $html;
        } else {
            return '';
        }
    }
}
