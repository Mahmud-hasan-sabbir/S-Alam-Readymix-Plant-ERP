<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class advancedSalary extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_id',
        'month',
        'year',
        'pay_mode',
        'bank_name',
        'acc_no',
        'advanced_salary',
        'status',
        'date',
        'remarks',
        'user_id',
    ];
  

    public function employee()
    {
        return $this->belongsTo(SallerInformation::class,'emp_id','id');
    }
}


