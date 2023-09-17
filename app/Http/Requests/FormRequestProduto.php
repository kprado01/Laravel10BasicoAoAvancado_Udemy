<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestProduto extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if($this->method() == 'GET'){
            return [];
        }

        return [
            'nome'  => 'required',
            'valor' => 'required',
        ];
    }
}
