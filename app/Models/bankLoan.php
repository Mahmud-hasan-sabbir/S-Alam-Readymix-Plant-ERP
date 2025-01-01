<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\accounts\BankInfo;

class bankLoan extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_id',
        'acc_no',
        'year_of_loan',
        'loan_amount',
        'interest_loan',
        'start_date',
        'end_date',
        'remarks',
        'year',
        'is_approve',
        'user_id',
    ];

    public function bank()
    {
        return $this->belongsTo(BankInfo::class, 'bank_id', 'id');
    }
}

