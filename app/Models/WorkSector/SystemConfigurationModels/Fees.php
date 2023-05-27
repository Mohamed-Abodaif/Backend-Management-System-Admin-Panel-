<?php

namespace App\Models\WorkSector\SystemConfigurationModels;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fees extends BaseModel
{
    use HasFactory,SoftDeletes;

    protected $table="fees";
    const ROUTE_PARAMETER_NAME = "fees";
    protected $fillable =[
        'name' , "status"
    ];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
    protected $casts = [
        'status'=>'boolean',
    ];
}