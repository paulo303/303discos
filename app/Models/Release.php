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
