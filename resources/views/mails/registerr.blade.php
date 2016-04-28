<h2>Bienvenid@ {{$data['name']}}</h2>
<h4>Haz clic en el siguiente enlace para confirmar su cuenta: &nbsp;&nbsp;</h4>
{!!Request::url()!!}/email/<?php echo $data['email']?>/confirm_token/<?php echo $data['confirm_token']?>
