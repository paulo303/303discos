<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateReleaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->release->id ?? '';

        return [
            'release_num' => [
                'required',
                'max:255',
            ],
            'cat_num' => [
                'required',
                'max:255',
                "unique:releases,cat_num,{$id}",
            ],
            'image' =>[
                'nullable',
                'image',
                'max:2048',
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.required'        => 'O campo <strong>:attribute</strong> é obrigatório!',
            '*.min'             => 'O campo <strong>:attribute</strong> deve ter no mínimo 3 caracteres!',
            '*.max'             => 'O campo <strong>:attribute</strong> deve ter no máximo 255 caracteres!',
            'cat_num.unique'    => 'O release <strong>:attribute</strong> já está cadastrado!',
            'image.max'          => 'O tamanho máximo para a <strong>:attribute</strong> é de 2mb!',
            'image.image'        => 'A <strong>:attribute</strong> precisa ser uma imagem!',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'release_num'  => 'Release Number',
            'cat_num'   => 'Cat Number',
            'image'  => 'Imagem',
        ];
    }
}
