<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accounts\tbl_coa;
use App\Models\SallerInformation;
use App\Models\land\DeedDetails;
use App\Models\land\LandDetails;
use App\Models\ploat\PloatDetail;

class Tbl_acc_transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'VNo',
        'Member_code',
        'Vtype',
        'VDate',
        'HeadCode',
        'Description',
        'Debit',
        'Credit',
        'StoreID',
        'IsPosted',
        'CreateBy',
        'UpdateBy',
        'IsAppove',
        'Co_remarks',
        'land_id',
        'ploat_id',

    ];

    public function headName()
    {
        return $this->belongsTo(tbl_coa::class,'HeadCode','HeadCode');
    }


    public function memberName()
    {
        return $this->belongsTo(SallerInformation::class,'Member_code','id');
    }

    public function ledgerName()
    {
        return $this->belongsTo(SallerInformation::class,'Member_code','id');
    }

    public function landName()
    {
        return $this->belongsTo(LandDetails::class,'land_id','id');
    }

    public function ploatName()
    {
        return $this->belongsTo(PloatDetail::class,'ploat_id','id');
    }






}
