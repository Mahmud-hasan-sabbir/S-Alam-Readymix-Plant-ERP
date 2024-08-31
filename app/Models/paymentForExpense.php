<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accounts\BankInfo;

class paymentForExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'ex_head_id',
        'pay_reason',
        'pay_mode',
        'pay_date',
        'bank_name',
        'check_num',
        'check_date',
        'pay_amount',
        'remarks',
        'is_approve',
        'user_id',
    ];

    public function expenseHead()
    {
        return $this->belongsTo(expenseHead::class, 'ex_head_id', 'id');
    }

    public function bankname()
    {
        return $this->belongsTo(BankInfo::class, 'bank_name', 'id');
    }
}


