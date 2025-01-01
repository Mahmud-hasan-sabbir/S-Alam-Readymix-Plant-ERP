<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class refundingPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'cus_id',
        'pay_reason',
        'pay_mode',
        'pay_date',
        'bank_name',
        'check_num',
        'check_date',
        'pay_amount',
        'remarks',
        'is_approve',
        'user_id',
    ];

    public function customerName()
    {
        return $this->belongsTo(SallerInformation::class,'cus_id','id');
    }
}



