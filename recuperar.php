<?php
@include 'config.php';
$email =$_POST['email'];
$bytes =random_bytes(5);
 $token = bin2hex($bytes);
@include 'emailrecu.php';

if($enviado){
    $meter = $conn->prepare("INSERT INTO `contras`(`email`, `token`, `codigo`) VALUES (?,?,?)") ;
    $meter->execute([$email, $token, $codigo]);
    echo '<p>Verifica ru email para restablecer cuenta</p>';
}

?>