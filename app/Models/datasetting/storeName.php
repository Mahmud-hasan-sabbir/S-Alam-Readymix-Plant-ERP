<?php

namespace App\Models\datasetting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class storeName extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'status',
    ];
}
