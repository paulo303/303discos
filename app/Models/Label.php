<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = ['name'];

    public function releases()
    {
        return $this->hasMany(Release::class);
    }

    /*** REGRAS DE NEGÓCIO ***/
    public function getAll(string|null $search = '')
    {
        $labels = $this->where(function ($query) use ($search){
            if ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            }
        })->paginate(10);

        return $labels;
    }
}
