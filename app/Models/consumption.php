<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\datasetting\grade;
use App\Models\invoice\invoice;
use App\Models\SallerInformation;

class consumption extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'invoice_id',
        'customer_id',
        'grade_id',
        'quantity',
        'black_stone',
        'mixed_builder',
        'dubai',
        'mm10',
        'pcc_cement',
        'opc_cement',
        'beg_cement',
        'sand',
        'admixer',
        'bricks',
        'status',
    ];


    public function grade()
    {
        return $this->belongsTo(grade::class, 'grade_id', 'id');
    }

    public function invam()
    {
        return $this->belongsTo(invoice::class, 'invoice_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(SallerInformation::class, 'customer_id', 'id');
    }
}


