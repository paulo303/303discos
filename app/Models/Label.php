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

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:40|unique:labels,name,' . $this->id
        ];
    }

    public function feedbacks()
    {
        return [
            'name.required' => 'O campo NOME é obrigatório!',
            'name.min' => 'O campo nome deve ter no mínimo 3 caracteres!',
            'name.max' => 'O campo nome deve ter no máximo 40 caracteres!',
            'name.unique' => 'O nome do selo já está cadastrado!'
        ];
    }
}
