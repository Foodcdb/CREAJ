<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Panel de administrador</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="icon" href="images/icon.png" type="icon">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="dashboard">

   <h1 class="title">Tablero</h1>

   <div class="box-container">

      <div class="box">
      <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_pendings->execute(['pendiente']);
         while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
            $total_pendings += $fetch_pendings['total_price'];
         };
      ?>
      <h3>$<?= $total_pendings; ?>/-</h3>
      <p>Total de pedidos</p>
      <a href="admin_orders.php" class="btn">Ver ordenes</a>
      </div>

      <div class="box">
      <?php
         $total_completed = 0;
         $select_completed = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_completed->execute(['completado']);
         while($fetch_completed = $select_completed->fetch(PDO::FETCH_ASSOC)){
            $total_completed += $fetch_completed['total_price'];
         };
      ?>
      <h3>$<?= $total_completed; ?>/-</h3>
      <p>Ordenes completas</p>
      <a href="admin_orders.php" class="btn">Ver ordenes</a>
      </div>

      <div class="box">
      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $number_of_orders = $select_orders->rowCount();
      ?>
      <h3><?= $number_of_orders; ?></h3>
      <p>Pedidos realizados</p>
      <a href="admin_orders.php" class="btn">Ver pedidos</a>
      </div>

      <div class="box">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $number_of_products = $select_products->rowCount();
      ?>
      <h3><?= $number_of_products; ?></h3>
      <p>Productos agregados</p>
      <a href="admin_products.php" class="btn">Ver productos</a>
      </div>
      <br>
      <div class="box">
      <?php
         $select_accounts = $conn->prepare("SELECT * FROM `users`");
         $select_accounts->execute();
         $number_of_accounts = $select_accounts->rowCount();
      ?>
      <h3><?= $number_of_accounts; ?></h3>
      <p>Total de cuentas</p>
      <a href="admin_users.php" class="btn">Ver cuentas</a>
      </div>

      <div class="box">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `message`");
         $select_messages->execute();
         $number_of_messages = $select_messages->rowCount();
      ?>
      <h3><?= $number_of_messages; ?></h3>
      <p>Total de mensajes</p>
      <a href="admin_contacts.php" class="btn">Ver mensajes</a>
      </div>

   </div>

</section>













<script src="js/script.js"></script>

</body>
</html>