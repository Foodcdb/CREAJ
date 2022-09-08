<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $sql = "SELECT * FROM `users` WHERE email = ? AND password = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$email, $pass]);
   $rowCount = $stmt->rowCount();  

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if($rowCount > 0){

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }else{
         $message[] = 'no se ha encontrado ningún usuario.';
      }

   }else{
      $message[] = 'Datos no encontrados!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Inicio</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/components.css">
   <link rel="icon" href="images/icon.png" type="icon">

</head>
<body>


<?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>

<div class="login-wp">
   <section class="form-container">

      <form action="" method="POST">
         <h3>Inicia sesión</h3>
         <input type="email" name="email" class="box" placeholder="Ingresa tu correo" >
         <input type="password" name="pass" class="box" placeholder="Ingresa tu contraseña">
         <input type="submit" value="iniciar sesión" class="btn" name="submit">
         <p>¿No tienes una cuenta?
         <a href="register.php">Regristrate ahora</a></p>
         <p>¿Olvidaste tu contraseña?
         <a href="validar.php">Recuperar contraseña</a></p>
         </form>
   </section>
</div>  
</body>
</html>