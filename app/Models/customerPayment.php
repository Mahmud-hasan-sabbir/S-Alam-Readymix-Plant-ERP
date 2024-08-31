<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\invoice\invoice;


class customerPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'inv_no',
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
        return $this->belongsTo(SallerInformation::class,'customer_id','id');
    }

    public function custotalamount()
    {
        return $this->belongsTo(invoice::class,'customer_id','cus_id');
    }
}


