<?php

include 'config.php';


if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass =$_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass =$_POST['cpass'];
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

 


   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   
   
   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);

   
   if($name ==""){
      $message[] = ("El campo nombre no puede estar vacio");
   }
   if($email == "" || strpos($email, "@")=== false){
      $message[]=("El correo no puede ser vacio.");
   }
   if($pass=="" || strlen($pass) < 7){
      $message[]=("El campo contraseña no puede estar vacio, ni tener menos de 8 caracteres");
   }
   if($image == ""){
      $message[]=("El campo imgen no puede ser vacio");
   }
   else{
    
      if($pass != $cpass){
         $message[] = '¡Confirmar contraseña no coincide!';
       
      }
      if($select->rowCount() > 0){
         $message[] = '¡El correo electrónico ya existe!';
      }
      else{
         
         $insert = $conn->prepare("INSERT INTO `users`(name, email, password, image) VALUES(?,?,?,?)");
         $insert->execute([$name, $email, md5($pass), $image]);

         $sql = "SELECT * FROM `users` WHERE email = ? ";
         $stmt = $conn->prepare($sql);
         $stmt->execute([$email]);
         $rowCount = $stmt->rowCount(); 
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         if($insert){
            if($image == ""){
               $message[]='Coloque una imagen para continuar';
            }
            if($image_size > 2000000){
               $message[] = 'El tamaño de la imagen es demasiado grande';
            }
            else{
               move_uploaded_file($image_tmp_name, $image_folder);
               $message[] = 'registro exitosamente!';
               session_start();

               $_SESSION['user_id'] = $row['id'];
               header('location:home.php');
               include 'email.php';
            }
            

      
         }

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
   <title>Registro</title>


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

      <form action="" enctype="multipart/form-data" method="POST">
       <h3>Registrarse ahora</h3>
       <input type="text" name="name" class="box" placeholder="Ingresa tu nombre" >
       <input type="email" name="email" class="box" placeholder="Ingresa tu correo">
       <input type="password" name="pass" class="box" placeholder="Ingresa tu contraseña">
       <input type="password" name="cpass" class="box" placeholder="confirma tu contraseña">
       <input type="file" name="image" class="box" require accept="image/jpg, image/jpeg, image/png">
       <input type="submit" value="registrarse ahora" class="btn" name="submit">
        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></p>
      </form>

   </section>
<div>

</body>
</html>