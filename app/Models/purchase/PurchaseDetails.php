<?php

namespace App\Models\purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\datasetting\materials;
use App\Models\datasetting\category;
use App\Models\datasetting\storeName;
use App\Models\datasetting\unit;

class PurchaseDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'category_id',
        'material_id',
        'store_id',
        'unit_id',
        'challan_no',
        'truck_no',
        'truck_fee',
        'Qty',
        'unit_price',
        'sub_total',
    ];

    public function material()
    {
        return $this->belongsTo(materials::class,'material_id','id');
    }
    public function category()
    {
        return $this->belongsTo(category::class,'category_id','id');
    }
    public function store()
    {
        return $this->belongsTo(storeName::class,'store_id','id');
    }
    public function unit()
    {
        return $this->belongsTo(unit::class,'unit_id','id');
    }
  

}




