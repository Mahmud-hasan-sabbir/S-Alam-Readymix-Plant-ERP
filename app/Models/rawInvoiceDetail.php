<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawInvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawInvoice_id',
        'category_id',
        'material_id',
        'store_id',
        'unit_id',
        'location',
        'Qty',
        'unit_price',
        'sub_total',
    ];
}


