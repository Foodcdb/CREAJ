<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   // $method = $_POST['method'];
   // $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = 'flat no. '.$_POST['street'] .' '. $_POST['city'] .' '. $_POST['state'] .' '. $_POST['country'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $placed_on = date('d-M-Y');

   if($name== ""){
      $message[]="El campo no puede ser vacio";
   }
   if($number== ""){
      $message[]="El campo no puede ser vacio";
   }
   if($email== ""){
      $message[]="El campo no puede ser vacio";
   }else{
      $cart_total = 0;
      $cart_products[] = '';
   
      $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $cart_query->execute([$user_id]);
      if($cart_query->rowCount() > 0){
         while($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)){
            $cart_products[] = $cart_item['name'].' ( '.$cart_item['quantity'].' )';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
         };
      };
   
      $total_products = implode(', ', $cart_products);
   
      $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
      $order_query->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);
   
      if($cart_total == 0){
         $message[] = 'tu carrito esta vacio';
      }elseif($order_query->rowCount() > 0){
         $message[] = '¡pedido realizado con éxito!';
      }else{
         $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, address, total_products, total_price, placed_on) VALUES(?,?,?,?,?,?,?,?,?)");
         $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on]);
         $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
         $delete_cart->execute([$user_id]);
         $message[] = '¡pedido realizado con éxito!';
      }
   }

  

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Verificar</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="icon" href="images/icon.png" type="icon">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="display-orders">

   <?php
      $cart_grand_total = 0;
      $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart_items->execute([$user_id]);
      if($select_cart_items->rowCount() > 0){
         while($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)){
            $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
            $cart_grand_total += $cart_total_price;
   ?>
   <p> <?= $fetch_cart_items['name']; ?> <span>(<?= '$'.$fetch_cart_items['price'].'/- x '. $fetch_cart_items['quantity']; ?>)</span> </p>
   <?php
    }
   }else{
      echo '<p class="empty">Tu carrito esta vacio¡</p>';
   }
   ?>
   <div class="grand-total">Total a pagar : <span>$<?= $cart_grand_total; ?>/-</span></div>
</section>

<section class="checkout-orders">

   <form action="" method="POST">

      <h3>Haz tu pedido</h3>

      <div class="flex">
         <div class="inputBox">
            <span>Tu nombre :</span>
            <input type="text" name="name" placeholder="Ingrese su nombre" class="box">
         </div>
         <div class="inputBox">
            <span>Tu numero :</span>
            <input type="number" name="number" placeholder="Ingrese su numero de telefono" class="box" >
         </div>
         <div class="inputBox">
            <span>Tu correo :</span>
            <input type="email" name="email" placeholder="Ingrese su correo electronico" class="box" >
         </div>
         <div class="inputBox">
            <span>línea de dirección 01 :</span>
            <input type="text" name="flat" placeholder="e.j.Numero de calle" class="box" >
         </div>
         <div class="inputBox">
            <span>línea de dirección 02:</span>
            <input type="text" name="street" placeholder="e.j. Nombre de calle" class="box" >
         </div>
         <div class="inputBox">
            <span>Ciudad</span>
            <input type="text" name="city" placeholder="e.j. Soyapango" class="box" >
         </div>
         <div class="inputBox">
            <span>Departamento :</span>
            <input type="text" name="state" placeholder="e.j. San Salvador" class="box" >
         </div>
         <div class="inputBox">
            <span>país:</span>
            <input type="text" name="country" placeholder="e.j. EL Salvador" class="box" >
         </div>
      
      </div>

      <input type="submit" name="order" class="btn <?= ($cart_grand_total > 1)?'':'disabled'; ?>" value="ordenar">
   </form>
   

</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>