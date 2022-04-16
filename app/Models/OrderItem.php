<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'release_id',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function release()
    {
        return $this->belongsTo(Release::class);
    }

    /*** REGRAS DE NEGÓCIO ***/
    public function getPaginate()
    {
        $order_items = $this->all()
            ->orderBy('id', 'desc')
            ->paginate(10);

        $order_items->load([
            'order',
            'release',
        ]);

        return $order_items;
    }

    public function getAll()
    {
        $labels = Label::orderBy('name', 'asc')->get();

        $labels->load([
            'releases',
        ]);

        return $labels;
    }

    public function findById($id)
    {
        $label = $this->find($id);

        $label->load([
            'releases',
        ]);

        return $label;
    }
}
