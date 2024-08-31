<?php

namespace App\Models\accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'branch_name',
        'acc_no',
        'routing_no',
        'acc_type',
        'holder_name',
        'status',
        'is_approve',
        'remarks',
        'user_id',
    ];
}


