<?php

namespace App\Models\datasetting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\datasetting\category;

class materials extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'status',
    ];


    public function categoryName()
    {
        return $this->belongsTo(category::class,'category_id','id');
    }
}


