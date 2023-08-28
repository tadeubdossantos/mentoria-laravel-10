<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestCliente extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    //regras e padrãoes para sererm definidos
    public function rules(): array
    {
        $request = [];
        //regras aplicadas somente quando houver request via post (envio de dados de formulário )
        if($this->method() == "POST" || $this->method() == "PUT") {
            return [
                'nome' => 'required'
            ];
        }
        return $request;
    }
}
