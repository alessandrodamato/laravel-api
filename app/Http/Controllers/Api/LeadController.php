<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request){

      $form_data = $request->all();

      $validator = Validator::make($form_data,
        [
          'name' => 'required|min:3|max:100',
          'surname' => 'required|min:3|max:100',
          'email' => 'required|email',
          'message' => 'required|min:10'
        ],
        [
          'name.required' => 'Il nome è un campo obbligatorio',
          'name.min' => 'Il nome deve avere almeno :min caratteri',
          'name.max' => 'Il nome può contenere massimo :max caratteri',
          'surname.required' => 'Il cognome è un campo obbligatorio',
          'surname.min' => 'Il cognome deve avere almeno :min caratteri',
          'surname.max' => 'Il cognome può contenere massimo :max caratteri',
          'email.required' => 'L\'email è un campo obbligatorio',
          'email.email' => 'L\'email inserita non è valida',
          'message.required' => 'Il messaggio è un campo obbligatorio',
          'message.min' => 'Il messaggio è troppo breve (min. :min caratteri)'
        ]
      );

      if($validator->fails()){
        $success = false;
        $errors = $validator->errors();
        return response()->json(compact('success', 'errors'));
      }

      $success = true;
      return response()->json(compact('success'));

    }
}
