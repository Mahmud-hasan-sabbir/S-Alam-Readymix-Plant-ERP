<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SallerInformation;

class transection extends Model
{
    use HasFactory;

    protected $fillable = [
        'Member_code',
        'VNo',
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

    ];

    public function sallername()
    {
        return $this->belongsTo(SallerInformation::class, 'Member_code', 'id');
    }
}


