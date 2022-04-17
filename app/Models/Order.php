<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'created_by',
        'store_id',
        'release_id',
        'order_status_id',
        'package_status_id',
        'order_priority_id',
        'price',
        'currency_id',
    ];

    // protected $appends = [
    //     'created_at_br',
    //     'updated_at_br',
    // ];

    public function getIdAttribute() {
        return str_pad($this->attributes['id'], 4, '0', STR_PAD_LEFT);
    }

    public function getCreatedAtAttribute() {
        return date('d/m/Y H:i:s', strtotime($this->attributes['created_at']));
    }

    public function getUpdatedAtAttribute() {
        return date('d/m/Y H:i:s', strtotime($this->attributes['updated_at']));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function release()
    {
        return $this->belongsTo(Release::class);
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function packageStatus()
    {
        return $this->belongsTo(PackageStatus::class);
    }

    public function priority()
    {
        return $this->belongsTo(OrderPriority::class, 'order_priority_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /*** REGRAS DE NEGÓCIO ***/
    public function getPaginate(Request $request)
    {
        $search = $request->search ? $request->search : '';
        $perPage = $request->perPage ? $request->perPage : '';

        $orders = $this->where(function ($query) use ($search){
            if ($search) {
                // $query->where('nome', 'LIKE', "%{$search}%");
                // $query->Orwhere('email', 'LIKE', "%{$search}%");
            }
        })
        ->orderBy('id', 'desc')
        ->paginate($perPage);

        $orders->load([
            'user.userType',
            'createdBy',
            'store',
            'release.label',
            'orderStatus',
            'packageStatus',
            'priority',
            'currency',
        ]);
        // dd($orders->toArray());

        return $orders;
    }
}
