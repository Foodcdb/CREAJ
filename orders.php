<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ordenar</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="icon" href="images/icon.png" type="icon">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="placed-orders">

   <h1 class="title">Pedidos realizados</h1>

   <div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <p> colocado en : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> nombre : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> Numero : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> Correo : <span><?= $fetch_orders['email']; ?></span> </p>
      <p> Direccion  : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> Tu orden : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> total : <span>$<?= $fetch_orders['total_price']; ?>/-</span> </p>
      <p> estado de pago : <span style="color:<?php if($fetch_orders['payment_status'] == 'pendiente'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty"> No tienes ningun pedido!</p>';
   }
   ?>

   </div>

</section>









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>