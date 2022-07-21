<?php
$destinatario ='creaj2022@gmail.com';
//esto es para quien es el correo
$email= $_POST['email'];
$name= $_POST['name'];

mail($email, "Bienvenidooo ",$name, " a un nuevo mundo de la comida", "FOOD kingdom");

include 'register.php';
?>