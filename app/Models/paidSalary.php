<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\accounts\BankInfo;

class paidSalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_id',
        'month',
        'year',
        'paid_salary',
        'pay_mode',
        'bank_name',
        'acc_no',
        'adv_salary',
        'status',
        'date',
        'remarks',
        'user_id',
    ];

    public function employee()
    {
        return $this->belongsTo(SallerInformation::class, 'emp_id', 'id');
    }

    public function bankname()
    {
        return $this->belongsTo(BankInfo::class, 'bank_name', 'id');
    }
}


