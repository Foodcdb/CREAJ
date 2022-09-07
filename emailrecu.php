<?php
$destinatario ='foodkingdomcreaj@gmail.com';
//esto es para quien es el correo
$email= $_POST['email'];
$mensaje;

$mensaje="RECUPERA TU CONTRASEÑA";
// título
$título = 'FOOD KINGDOOM';
$codigo=rand(1000,9999);

// mensaje
$mensaje = '
<html>
<head>
  <title>restablecer contraseña</title>
</head>
<body>
  <h1>¡Recupera tu contraseña!</h1>
  <h3>'.$codigo.'</h3>
  <p><a href="http://localhost:3000/reset.php?email='.$email.'&token='.$token.'">
  para restablecer da click aqui</a>
  </p>
  <p>!Si usted no envio la solicitud ignore el mensaje¡</p>
</body>
</html>
';
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Enviarlo
$enviado =false;
if( mail($email, $título, $mensaje, $cabeceras)){
    $enviado =true;
}




?>
