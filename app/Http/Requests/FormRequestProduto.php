<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestProduto extends FormRequest
{
    //antes estava com 'false' mas deve estar com 'true' para autorizar fazer a validação
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
                'nome' => 'required',
                'valor' => 'required'
                
            ];
        }
        return $request;
    }
}
