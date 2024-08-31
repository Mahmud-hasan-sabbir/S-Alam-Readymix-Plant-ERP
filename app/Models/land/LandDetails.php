<?php

namespace App\Models\land;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SallerInformation;

class LandDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'land_owner_id',
        'RS_num',
        'CS_num',
        'SA_num',
        'BRS_num',
        'Mouza_name',
        'Khotiun_no',
        'joth_number',
        'porcha_no',
        'namjari_no',
        'dcr_no',
        'khajna_no',
        'prostabona_no',
        'dolil_no',
        'dolil_date',
        'baya_dolil_no',
        'dugh_no',
        'Available_area',
        'land_status',
        'gross_area',
    ];

    public function supplierName()
    {
        return $this->belongsTo(SallerInformation::class,'land_owner_id','id');
    }
}
