<?php

namespace App\Models;

use App\Models\datasetting\grade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\invoice\invoice;

class invoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'inv_id',
        'grade_id',
        'location',
        'qty_m3',
        'qty_cft',
        'unit_price_cft',
        'service_search',
        'sub_total',
    ];

    public function grade()
    {
        return $this->belongsTo(grade::class,'grade_id','id');
    }

    public function invoice()
    {
        return $this->belongsTo(invoice::class,'inv_id','id');
    }
}


