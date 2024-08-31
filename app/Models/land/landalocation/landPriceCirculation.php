<?php

namespace App\Models\land\landalocation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\land\DeedDetails;
use App\Models\land\LandDetails;

class landPriceCirculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'land_id',
        'land_rate',
        'asso_profit',
        'total_rate',
        'dec_date',
        'remarks',
        'media_name',
        'send_filling_cost',
        'demurcution_cost',
        'bs_jorip_cost',
        'development_cost',
        'misc_cost',

    ];



    public function DeedDetails()
    {
        return $this->belongsTo(DeedDetails::class,'land_id','id');
    }

    public function landDetails()
    {
        return $this->belongsTo(LandDetails::class,'land_id','id');
    }

    public function purchasearea()
    {
        return $this->belongsTo(DeedDetails::class,'land_id','land_id');
    }


}
