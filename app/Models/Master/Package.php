<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'threshold_amount',
    ];

    public static $rules    = [
      'name'                => 'required',
      'threshold_amount'    => 'required',
    ];

    public function points()
    {
        return $this->hasMany('App\Models\Master\PackagePoint','package_id'); 
    }
}
