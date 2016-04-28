<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class cotizacionrequest extends Request
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
            'name' => 'required|min:3|max:70|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email'=>'email',
            'phone'=>'required|digits_between:6,15',
            'oficioprofesion'=>'required|alpha|min:2|max:70',
            'destinocredito'=>'required|min:2|max:70',
            'g-recaptcha-response' => 'required|recaptcha',
        ];
    }

     public function messages()
     {
        return [
            'name.required'=>'Por favor complete su nombre',
            'name.min'=>'El nombre debe tener al menos 2 caracteres',
            'name.max'=>'El nombre no debe tener mas de 70 caracteres',
            'name.regex'=>'El nombre solo debe contener letras',

            'phone.required'=>'Por favor ingrese su numero telefonico',
            'phone.numeric'=>'El número de teléfono debe estar conformado por solo números',
            'phone.min'=>'El número de telefono debe tener al menos 6 numeros',
            'phone.max'=>'El número de telefono no debe tener más de 13 numeros',
            

            'oficioprofesion.required'=>'Por favor complete su profesión',
            'oficioprofesion.alpha'=>'La profesión solo debe contener letras',
            'oficioprofesion.min'=>'La profesión debe tener al menos 2 caracteres',
            'oficioprofesion.max'=>'La profesión solo puede tener máximo 70 caracteres',

            'destinocredito.required'=>'Por favor complete el destino del credito',
            'destinocredito.min'=>'El destino del crédito debe tener al menos 2 caracteres',
            'destinocredito.max'=>'El  destino del crédito solo puede tener máximo 70 caracteres',

            'g-recaptcha-response.required'=>'El campo captcha es requerido',
            'g-recaptcha-response.recaptcha'=>'Captcha incorrecto',

        ];
     }
}
