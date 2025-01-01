<?php

namespace App\Models\land\landalocation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SallerInformation;
use App\Models\land\DeedDetails;
use App\Models\land\LandDetails;
use App\Models\land\landalocation\landPriceCirculation;

class landAlocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'land_id',
        'alo_date',
        'alo_size',
        'land_rate',
        'description',
        'available_size',
        'other_cost',
        'reg_fee',
        'total_amount',
    ];


    public function memberName()
    {
        return $this->belongsTo(SallerInformation::class,'member_id','id');
    }
    public function landDetails()
    {
        return $this->belongsTo(DeedDetails::class,'land_id','id');
    }

    public function land()
    {
        return $this->belongsTo(landPriceCirculation::class,'land_id','id');
    }


}
