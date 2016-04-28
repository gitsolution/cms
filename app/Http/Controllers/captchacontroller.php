<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class captchacontroller extends Controller
{
    //
    header("content-type: image/png");
    $imagen = imagecreate(100,80) or die ("Ha ocurrido un error al generar captcha");
    $color_fondo=imagecolorallocate($imagen,0,0,0);
    $color_texto=imagecolorallocate($imagen,255,255,255);

    function generate_captcha($chars,$length)
    {
    	for($x=0;$x<length;$x++)
    	{
    		$rand=rand(0,count($chars)-1);
    	}
    
    	return $captcha;
    }

   $captcha=generate_captcha(array(0,1,2,3,4,5,6,7,8,9,0,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z'),4);

   setcookie('captcha',sha1($captcha),time()+60*3);

   imagestring($imagen, 5, 5, 5, $captcha,$color_texto)
   imagepng($imagen);

    
}
