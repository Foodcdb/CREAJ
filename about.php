<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

// Mati estuvo aquí :P - 21/7


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="about">

   <div class="row">

      <div class="box">
         <img src="images/about-img-1.jpg" high="534" width="500">
         <h3>¿Por qué elegirnos?</h3>
         <p>Somos una página la cual trata de saciar tu hambre, para que puedas evitar la aglomeración en este periodo de pandemia, facilitando la entrega del  producto y las reservaciones.</p>
         <a href="contact.php" class="btn">Contactate con nosotros</a>
      </div>

      <div class="box">
         <img src="images/about-img-2.jpg" high="534" width="500">
         <h3>¿Qué proporcionamos?</h3>
         <p>Ser una página web confiable la cual satisface los pedidos de los usuarios, atendiendo de la mejor manera de forma amigable y con amabilidad.</p>
         <a href="shop.php" class="btn">Nuestra tienda</a>
      </div>

   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>