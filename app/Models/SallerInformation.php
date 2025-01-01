<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Designation;

class SallerInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'project_name',
        'contact_person',
        'mobile_no',
        'Email',
        'Designation',
        'Date_of_join',
        'Gender',
        'Status',
        'salary',
        'Address',
        'security_cheque',
        'bank_guaranty',
        'attachment',
        'work_order',
        'nid',
        'image',
        'opening_date',
        'note',
        'Category',
        'user_id',

    ];


    public function desig()
    {
        return $this->belongsTo(Designation::class,'Designation','id');
    }




}

