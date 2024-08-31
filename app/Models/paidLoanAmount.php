<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\accounts\BankInfo;

class paidLoanAmount extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_id',
        'acc_no',
        'loan_amount',
        'interest_loan',
        'date',
        'remarks',
        'year',
        'pay_loan_amount',
        'is_approve',
        'user_id',
    ];

    public function bank()
    {
        return $this->belongsTo(BankInfo::class, 'bank_id', 'id');
    }

}


