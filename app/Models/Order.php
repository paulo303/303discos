<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'release_id',
        'order_status_id',
        'priority',
        'price',
        'link',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function release()
    {
        return $this->belongsTo(Release::class);
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function packageDetails()
    {
        return $this->hasMany(PackageDetail::class);
    }
}
