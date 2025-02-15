<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'RI_No',
        'order_date',
        'customer_id',
        'Total_sale_amount',
        'discount',
        'status',
        'is_approve',
        'remarks',
        'user_id',
    ];

    public function rawInvoiceDetail()
    {
        return $this->hasMany(rawInvoiceDetail::class, 'rawInvoice_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(SallerInformation::class, 'customer_id', 'id');
    }
}


