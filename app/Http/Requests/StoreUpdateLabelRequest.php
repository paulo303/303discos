<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateLabelRequest extends FormRequest
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
        $id = $this->label->id ?? '';

        return [
            'name' => [
                'required',
                'min:3',
                'max:255',
                "unique:labels,name,{$id}",
            ],
            'url' => [
                "unique:labels,url,{$id}"
            ],
            'logo' =>[
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
            '*.required'    => 'O campo <strong>:attribute</strong> é obrigatório!',
            'name.min'      => 'O campo <strong>:attribute</strong> deve ter no mínimo 3 caracteres!',
            'name.max'      => 'O campo <strong>:attribute</strong> deve ter no máximo 255 caracteres!',
            'name.unique'   => 'O <strong>:attribute</strong> do Selo já está cadastrado!',
            'url.unique'    => 'A <strong>:attribute</strong> já está cadastrada!',
            'logo.max'      => 'O tamanho máximo para a <strong>:attribute</strong> é de 2mb!',
            'logo.image'    => 'A <strong>:attribute</strong> precisa ser uma imagem!',
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
            'name'  => 'Nome',
            'url'   => 'URL',
            'logo'  => 'Logo',
        ];
    }
}
