<?php
@include 'config.php';
$email =$_POST['email'];
$token =$_POST['token'];
$codigo =$_POST['codigo'];
$res = $conn->prepare("SELECT * FROM `contras` WHERE email =?") or die($conn->error);
      $res->execute([$email]);
    if($res->rowCount() > 0){
        $fila =$res->rowCount();
        $fecha=$fila[4];
    //      while($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)){
    //         $cart_products[] = $cart_item['name'].' ( '.$cart_item['quantity'].' )';
    //         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
    //         $cart_total += $sub_total;
        }else{
            echo "codigo incorrecto";
        }
         
?>