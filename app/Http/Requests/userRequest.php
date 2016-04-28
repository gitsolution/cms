<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class userRequest extends Request
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
            'name' => 'required|min:2|max:30|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'lastName'=>'required|min:3|max:70|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|max:18|confirmed',
        ];
    }

     public function messages()
     {
       return [
            'name.required'=>'Por favor complete su nombre',
            'name.min'=>'El nombre debe tener al menos 2 caracteres',
            'name.max'=>'El nombre no debe tener mas de 30 caracteres',
            'name.regex'=>'El nombre solo debe contener letras',
        

            'lastName.required'=>'Por favor complete su apellido',
            'lastName.min'=>'El apellido debe tener al menos 2 caracteres',
            'lastName.max'=>'El apellido no debe tener mas de 50 caracteres',
            'lastName.regex'=>'El apellido solo debe contener letras',

            'email.required' => 'El campo email es requerido',
            'email.email' => 'El formato de email es incorrecto',
            'email.max' => 'El máximo de caracteres permitidos son 255',
            'email.unique' => 'El email ya existe',

            'password.required' => 'La contraseña es requerido',
            'password.min' => 'El mínimo de caracteres permitidos son 6',
            'password.max' => 'El máximo de caracteres permitidos son 18',
            'password.confirmed' => 'Los passwords no coinciden',
        ];
     }
}
