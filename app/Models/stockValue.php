<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\datasetting\materials;

class stockValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_id',
        'store_id',
        'pur_qty',
        'sale_qty',
        'cur_qty',
        'user_id',
    ];

    public function material()
    {
        return $this->belongsTo(materials::class, 'material_id', 'id');
    }
}

