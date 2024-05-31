<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
          'name' => 'required|min:3|max:100',
          'creator' => 'required|min:3|max:100',
          'objective' => 'required|min:3|max:50',
          'file' => "mimes:pdf|max:20000",
          'description' => 'required|min:30'
        ];
    }

    public function messages(){
      return [
        'name.required' => 'Inserire il nome',
        'name.min' => 'Il nome deve avere almeno :min caratteri',
        'name.max' => 'Il nome deve avere massimo :max caratteri',
        'creator.required' => 'Inserire il creatore',
        'creator.min' => 'Il campo creatore deve avere almeno :min caratteri',
        'creator.max' => 'Il campo creatore deve avere massimo :max caratteri',
        'objective.required' => 'Inserire l\'obiettivo',
        'objective.min' => 'Il campo obiettivo deve avere almeno :min caratteri',
        'objective.max' => 'Il campo obiettivo deve avere massimo :max caratteri',
        'file.mimes' => 'Il file caricato non è in formato .pdf',
        'file.max' => 'Il file caricato è troppo grande (max. 20mb)',
        'description.required' => 'La descrizione è obbligatoria',
        'description.min' => 'La descrizione è troppo breve (inferiore a :min caratteri)'
      ];
    }

}
