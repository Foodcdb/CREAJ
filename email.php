<?php

session_start();

$_SESSION['user_id'] = $row['id'];
header('location:home.php');

$destinatario ='foodkingdomcreaj@gmail.com';
//esto es para quien es el correo
$email= $_POST['email'];
$name=$_POST['name'];
$mensaje;

$mensaje="Bienvenido a un nuevo mundo de la comida";
// título
$título = 'FOOD KINGDOOM';

// mensaje
$mensaje = '
<html>
<head>
  <title>Bienvenido</title>
</head>
<body>
  <h1>¡Bienvenido a un nuevo reino de la comida!</h1>
  <img src="../images/gmail.jpg" width="50px">
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

/* Cabeceras adicionales
$cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
$cabeceras .= 'From: Recordatorio <cumples@example.com>' . "\r\n";
$cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";*/

// Enviarlo
mail($email, $título, $mensaje, $cabeceras);



?>
