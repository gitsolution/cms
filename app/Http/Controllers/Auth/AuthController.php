<?php

namespace App\Http\Controllers\Auth;
use App\User;
use App\usr_profile;
use DB;
use Auth;
use Session;
use Redirect; 
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Mail;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */

    protected $redirectTo = '/admin';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
   

    
    public function postRegister(Request $request)
    {
        $rules=[
            'name' => 'required|min:2|max:30|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'lastName'=>'required|min:3|max:70|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|max:18|confirmed',
            'g-recaptcha-response' => 'required|recaptcha',
        ];


         $messages = [
            'name.required'=>'Por favor complete su nombre',
            'name.min'=>'El nombre debe tener al menos 2 caracteres',
            'name.max'=>'El nombre no debe tener mas de 30 caracteres',
            'name.regex'=>'El nombre solo debe contener letras',
        

            'lastName.required'=>'Por favor complete su apellido',
            'lastName.min'=>'El apellido debe tener al menos 2 caracteres',
            'lastName.max'=>'El apellido no debe tener mas de 50 caracteres',
            'lastName.regex'=>'El apellido solo debe contener letras',

            'email.required' => 'El campo es requerido',
            'email.email' => 'El formato de email es incorrecto',
            'email.max' => 'El máximo de caracteres permitidos son 255',
            'email.unique' => 'El email ya existe',

            'password.required' => 'El campo es requerido',
            'password.min' => 'El mínimo de caracteres permitidos son 6',
            'password.max' => 'El máximo de caracteres permitidos son 18',
            'password.confirmed' => 'Los passwords no coinciden',

            'g-recaptcha-response.required'=>'El campo captcha es requerido',
            'g-recaptcha-response.recaptcha'=>'Captcha incorrecto',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

    
        if ($validator->fails())
        {
             return redirect("auth/register")->withErrors($validator)->withInput();
        }

        else
        {
            $user = new User;
            $data['email']=$user->email = $request->email;
            $user->password = ($request->password);//bcrypt
            $user->active='0';
            $user->remember_token = str_random(100);
            $data['confirm_token']=$user->confirm_token = str_random(100);
            $user->save();

            $usr=DB::table('users')->where('email',$request->email)->select('id')->first();
            $perfil = new usr_profile;
            $perfil->id=$usr->id;
            $data['name']=$perfil->name=$request->name;
            $perfil->lastname=$request->lastName;
            $perfil->save();

            Mail::send('mails/registerr', ['data' => $data], function($mail)
                use($data){
                 $mail->subject('Confirma tu cuenta');
                 $mail->to($data['email'], $data['name']);
                
            });

            return redirect("auth/register")->with("message", "Hemos enviado un enlace de confirmación a su cuenta de correo electrónico");
        }
    }


    public function confirmRegister($email, $confirm_token)
    {
        $user = new User;
        $the_user = $user->select()->where('email', '=', $email)
        ->where('confirm_token', '=', $confirm_token)->get();

        if (count($the_user) > 0)
        {
            $active = 1;
            $confirm_token = str_random(100);
            $user->where('email', '=', $email)
            ->update(['active' => $active, 'confirm_token' => $confirm_token]);
            
            Auth::logout();
            return Redirect::to("login");
        }

        else
        {
            return redirect('/Inicio');
        }

    }

}
