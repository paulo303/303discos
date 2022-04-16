<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'link',
        'logo',
    ];

    /*** REGRAS DE NEGÓCIO ***/
    public function getPaginate(string|null $search = '')
    {
        $stores = $this->where(function ($query) use ($search){
            if ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            }
        })
        ->orderBy('id', 'asc')
        ->paginate(10);

        return $stores;
    }
}
