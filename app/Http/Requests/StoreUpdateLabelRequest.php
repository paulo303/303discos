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
        return [
            'name' => [
                'required',
                'min:3',
                'max:255',
                'unique:labels,name,' . $this->url,
            ],
            'url' => [
                'required',
                'unique:labels,url,'. $this->url
            ],
            'logo' =>[
                'nullable',
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
            '*.required'    => 'O campo :attribute é obrigatório',
            'name.min'      => 'O campo :attribute deve ter no mínimo 3 caracteres',
            'name.max'      => 'O campo :attribute deve ter no máximo 255 caracteres',
            'name.unique'   => 'O nome do selo já está cadastrado',
            'url.unique'    => 'A URL já está cadastrada',
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
