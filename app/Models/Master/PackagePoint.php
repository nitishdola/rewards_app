<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagePoint extends Model
{
    use HasFactory;


    protected $fillable = [
        'package_id',
        'min_points', 
        'max_points',
        'percentage',
    ];

    public static $rules    = [
        'package_id'        => 'required|exists:packages,id',
        'min_points'        => 'numeric|required',
        'max_points'        => 'numeric',
        'percentage'        => 'numeric|required', 
    ];
}
