<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Label extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'url',
        'discogs',
        'logo',
    ];

    public function releases()
    {
        return $this->hasMany(Release::class);
    }

    /*** REGRAS DE NEGÓCIO ***/
    public function getPaginate(string|null $search = '')
    {
        $labels = $this->where(function ($query) use ($search){
            if ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            }
        })
        ->orderBy('name', 'asc')
        ->paginate(10);

        $labels->load([
            'releases',
        ]);

        return $labels;
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

    public function findByURL($url)
    {
        return $this->where('url', $url)->first();
    }
}
