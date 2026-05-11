<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicacaoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo'      => ['required', 'string', 'max:255'],
            'subtitulo'   => ['required', 'string', 'max:255'],
            'corpo'       => ['required', 'string'],
            'categorias'  => ['required', 'array', 'min:1'],
            'categorias.*' => ['exists:categorias,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required'      => 'O título é obrigatório.',
            'subtitulo.required'   => 'O subtítulo é obrigatório.',
            'corpo.required'       => 'O corpo do artigo é obrigatório.',
            'categorias.required'  => 'Selecione ao menos uma categoria.',
            'categorias.min'       => 'Selecione ao menos uma categoria.',
            'categorias.*.exists'  => 'categorias informadas são inválidas.',
        ];
    }
}
