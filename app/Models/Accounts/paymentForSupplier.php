<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SallerInformation;
use App\Models\purchase\Purchase;

class paymentForSupplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'po_no',
        'pay_reason',
        'pay_mode',
        'pay_date',
        'bank_name',
        'check_num',
        'check_date',
        'discount_amount',
        'pay_amount',
        'remarks',
        'is_approve',
        'user_id',
    ];

    public function supplierName()
    {
        return $this->belongsTo(SallerInformation::class,'supplier_id','id');
    }
    public function poNo()
    {
        return $this->hasMany(Purchase::class,'supplier_id','supplier_id');
    }
}


