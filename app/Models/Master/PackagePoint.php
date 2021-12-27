<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagePoint extends Model
{
    use HasFactory;


    protected $fillable = [
        'point_from', 
        'point_to',
        'percentage',
    ];

    public static $rules    = [
      'point_from'  => 'numeric|required',
      'point_to'    => 'numeric',
      'percentage'  => 'numeric|required', 
    ];
}
