<?php

namespace App\Models\invoice;

use App\Models\invoiceDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SallerInformation;
use App\Models\consumption;


class invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'inv_no',
        'date',
        'cus_id',
        'description',
        'total_amount',
        'status',
        'consum',
        'user_id',
    ];

    public function customerName()
    {
        return $this->belongsTo(SallerInformation::class,'cus_id','id');
    }

    public function invdetail()
    {
        return $this->hasMany(invoiceDetail::class,'inv_id','id');
    }

    public function consum()
    {
        return $this->hasMany(consumption::class, 'invoice_id', 'id');
    }
}


