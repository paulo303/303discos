<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    use HasFactory;

    protected $fillable = [
        'label_id',
        'release_num',
        'cat_num',
        'image',
    ];

    public function label()
    {
        return $this->belongsTo(Label::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /*** REGRAS DE NEGÓCIO ***/
    public function getPaginate(string|null $search = '')
    {
        $releases = $this->where(function ($query) use ($search){
            if ($search) {
                $query->where('release_num', 'LIKE', "%{$search}%");
                $query->orWhere('name', 'cat_num', "%{$search}%");
            }
        })
        ->orderBy('release_num', 'asc')
        ->paginate(10);

        $releases->load([
            'label',
        ]);

        return $releases;
    }

    public function getAll()
    {
        $releases = $this->orderBy('release_num', 'asc')->get();

        $releases->load([
            'label',
        ]);

        return $releases;
    }



    public function findById($id)
    {
        $release = $this->find($id);

        $release->load([
            'label',
        ]);

        return $release;
    }

    public function findByCatNum($catNum)
    {
        $release = $this->where('cat_num', $catNum)->first();

        $release->load([
            'label',
        ]);

        return $release;
    }

    public function rules()
    {
        return [
            'label_id' => 'required',
            'release_num' => 'required',
            'cat_num' => 'required|unique:releases',
        ];
    }

    public function feedbacks()
    {
        return [
            'label_id.required' => 'O campo LABEL é obrigatório!',
            'release_num.required' => 'O campo RELEASE number é obrigatório!',
            'cat_num.required' => 'O campo CAT NUMBER é obrigatório!',
            'cat_num.unique' => 'O CAT NUMBER já está cadastrado!'
        ];
    }
}
