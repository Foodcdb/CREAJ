<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_wishlist'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_wishlist_numbers->rowCount() > 0){
      $message[] = 'Añadido a la lista de deseos!';
   }elseif($check_cart_numbers->rowCount() > 0){
      $message[] = 'Ya está añadido al carrito!';
   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'Añadido a la lista de deseos!';
   }

}

if(isset($_POST['add_to_cart'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_cart_numbers->rowCount() > 0){
      $message[] = 'Producto ya añadido al carrito!';
   }else{

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->execute([$p_name, $user_id]);
      }

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      $message[] = 'Agregado al carrito!';
   }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>FOOD</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">



</head>
<body>
   
<?php include 'header.php'; ?>

<div class="home-bg">

   <section class="home">

      <div class="content">
         <span>Buena comida, buen humor.</span>
         <h3>Reino de la Comida</h3>
         <p>¡Cualquier día es perfecto para darte un gusto!</p>
         <a href="about.php" class="btn">Sobre Nosotros</a>

         <section>
          <button  id="open">
            RSE-Ecologia
          </button>
       
         </section>
      </div>
   </section>
</div>
<div class="modal_container" id="modal_container" >
             <div class="modal">
               <img class="imagen" src="images/ma.jpg" alt="medio ambiente">
               <br>
               <p class="letra">Cuidemos el medio hambiente</p>
               <button id="close">cerrar</button>
            </div>
</div>


<section class="home-category">

   <h1 class="title">Menú</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/Hamburguesa.jpg" alt="">
         <h3>Hamburguesas</h3>
         <p>Degusta de estas exquisitas hamburguesas.</p>
         <a href="category.php?category=Hamburguesas" class="btn">Hamburguesas</a>
      </div>

      <div class="box">
         <img src="images/Pizza.jpg" alt="">
         <h3>Pizza</h3>
         <p>Pizzas para esos días para estar con la familia o amigos.</p>
         <a href="category.php?category=Pizzas" class="btn">Pizza</a>
      </div>

      <div class="box">
         <img src="images/Pollo.jpg" alt="">
         <h3>Pollo</h3>
         <p>Rico pollo para degustar a tu paladar.</p>
         <a href="category.php?category=Pollo" class="btn">Pollo</a>
      </div>

      <div class="box">
         <img src="images/Bebidas.jpg" alt="">
         <h3>Bebidas</h3>
         <p>Degusta de nuestras bebidas para matar esa sed.</p>
         <a href="category.php?category=Bebidas" class="btn">Bebida</a>
      </div>

      <div class="box">
         <img src="images/sopi.jpg" alt="">
         <h3>Sopa</h3>
         <p>Degusta de nuestras bebidas para matar esa sed.</p>
         <a href="category.php?category=Sopa" class="btn">Sopa</a>
      </div>

      <div class="box">
         <img src="images/china.jpg" alt="">
         <h3>Comida china</h3>
         <p>Degusta de nuestras bebidas para matar esa sed.</p>
         <a href="category.php?category=China" class="btn">Comida china</a>
      </div>

      <div class="box">
         <img src="images/postres.jpg" alt="">
         <h3>Postres</h3>
         <p>Degusta de nuestras bebidas para matar esa sed.</p>
         <a href="category.php?category=Postres" class="btn">Postres</a>
      </div>

      <div class="box">
         <img src="images/Pizza-1.jpg" alt="">
         <h3>Combo</h3>
         <p>Adquiere nuestros a menores precios.</p>
         <a href="category.php?category=Combo" class="btn">Combo</a>
      </div>

   </div>

</section>

<section class="products">

   <h1 class="title">Ultimos productos</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
      <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
      <input type="number" min="1" value="1" name="p_qty" class="qty">
      <input type="submit" value="Agregar lista de deseo" class="option-btn" name="add_to_wishlist">
      <input type="submit" value="Agregar al Carrito" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>


   </div>

</section>







<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>