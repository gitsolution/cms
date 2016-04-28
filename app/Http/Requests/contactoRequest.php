<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class contactoRequest extends Request
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
            'asunt'=>'required',
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

            'email'=>'Ingrese de manera correcta su correo',

            'phone.required'=>'Por favor ingrese su numero telefonico',
            'phone.digits_between'=>'El número de teléfono debe tener al menos 2 o hasta 15 numero',

            'asunt.required'=>'Por favor agrege un asunto',
            'g-recaptcha-response.required'=>'El campo captcha es requerido',
            'g-recaptcha-response.recaptcha'=>'Captcha incorrecto',

        ];
    }
}
