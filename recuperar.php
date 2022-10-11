<?php
   include("conexion.php");
   session_start();

   require_once('accesos.php');
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form       

      $myusername = $_POST['email']; 
      $mypassword = $_POST['password'];
      
      if ($myusername != "" && $mypassword != "") {
      
         if (countUsuario($myusername,$mypassword) == 1) {
         
              $resultado = getLogin($myusername,$mypassword);      

              $tipo_usuario = $resultado['tipo_usuario'];
             
              // If result matched $myusername and $mypassword, table row must be 1 row
                
              if($tipo_usuario == "Admin") {
                 //session_register("myusername");
                 $_SESSION['login_user'] = $myusername;             
                 header("location: inicio.php");
              }else {
                 $error = "Your Login Name or Password is invalid";
              }
          }else {
            header("location: login.php");
          }    

       }else{
          header("location: login.php");
       }    
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body style="text-align: center;">
    
    <div class="login-box">
        <img class ="avatar" src="image/escudo1.png" alt="logo" />
        <img src="image/logo.png" weight="20" height="40">
   <p>
        <form method="post" action="">     
            <label for="email">Nueva Contraseña</label>
            <input type="text" name="email" placeholder="Nueva Contraseña">
            <label for="password">Confirmar</label>
            <input type="password" name="password" placeholder="Confirma nueva Contraseña">
            <input type="submit" name="Ingresar" value="Enviar"/>
            <br>
        </form>
    </div>
</body>
</html>