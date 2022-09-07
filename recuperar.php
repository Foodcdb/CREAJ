<?php
@include 'config.php';
$email =$_POST['email'];

$token = random_bytes(5);
@include 'emailrecu.php';

if($enviado){
    $insert = $conn->prepare("INSERT INTO `contras`(email, token, codigo) VALUES('?','?','?')") or die($insert->error);
    $insert->execute([$email, $token, $codigo]);
    echo '<p>Verifica ru email para restablecer cuenta</p>';
}





?>