<?php

namespace App\Models\payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SallerInformation;
use App\Models\land\LandDetails;

class PaymentLand extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'land_id',
        'plot_id',
        'purchase_type',
        'pay_mode',
        'check_num',
        'check_date',
        'pay_type',
        'pay_amount',
        'pay_date',
        'recived_by',
        'mem_bayna_id',
        'is_approve',
        'mem_mounth_fee',
        'mem_form_fee',
        'mem_land_sale_fee',
        'remarks',
        'user_id',
        'ledger_code'
    ];

    public function memberName()
    {
        return $this->belongsTo(SallerInformation::class, 'member_id','id');
    }

    public function employeeName()
    {
        return $this->belongsTo(SallerInformation::class, 'recived_by','id');
    }

    public function landName()
    {
        return $this->belongsTo(LandDetails::class, 'land_id','id');
    }


}

