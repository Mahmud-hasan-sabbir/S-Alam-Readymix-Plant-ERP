<?php

namespace App\Models\land;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SallerInformation;
use App\Models\land\LandDetails;
use App\Models\land\landalocation\landPriceCirculation;
use App\Models\member\memberDeed;

class DeedDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'deed_date',
        'land_owner_id',
        'land_id',
        'media_id',
        'available_size',
        'purchase_size',
        'sale_size',
        'land_rate',
        'total_amount',
        'misc_cost',
        'reg_bayna',
        'pay_deadline_date',
        'remarks',
        'file',
        'is_approve',
    ];
    public function supplierName()
    {
        return $this->belongsTo(SallerInformation::class,'land_owner_id','id');
    }

    public function memberdeed()
    {
        return $this->belongsTo(memberDeed::class,'land_id','land_id');
    }

    public function mediaName()
    {
        return $this->belongsTo(SallerInformation::class,'media_id','id');
    }

    public function landDetails()
    {
        return $this->belongsTo(LandDetails::class,'land_id','id');
    }

    public function landPriceCirculation()
    {
        return $this->belongsTo(LandPriceCirculation::class, 'land_id', 'land_id');
    }




}
