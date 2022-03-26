<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_status_id',
        'delivery_price',
        'exchange_price',
        'total_price',
    ];

    public function packageStatus()
    {
        return $this->belongsTo(PackageStatus::class);
    }

    public function packageDetails()
    {
        return $this->hasMany(PackageDetail::class);
    }
}
