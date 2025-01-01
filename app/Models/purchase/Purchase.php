<?php

namespace App\Models\purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SallerInformation;
use App\Models\datasetting\storeName;
use App\Models\purchase\purchaseDetails;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'PO_No',
        'order_date',
        'supplier_id',
        'Total_purchase_amount',
        'discount',
        'status',
        'is_approve',
        'remarks',
        'user_id',

    ];

    public function supplierName()
    {
        return $this->belongsTo(SallerInformation::class,'supplier_id','id');
    }

    public function storeName()
    {
        return $this->belongsTo(storeName::class,'store_id','id');
    }

    public function purchaseDetails()
    {
        return $this->hasMany(purchaseDetails::class,'purchase_id','id');
    }
}





