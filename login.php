<?php
   include("conexion.php");
   session_start();

   require_once('accesos.php');
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // nombre de usuario y contraseña enviados desde el formulario      

      $myusername = $_POST['email']; 
      $mypassword = $_POST['password'];
      
      if ($myusername != "" && $mypassword != "") {
      
         if (countUsuario($myusername,$mypassword) == 1) {
         
              $resultado = getLogin($myusername,$mypassword);      

              $tipo_usuario = $resultado['tipo_usuario'];
             
              // validacion de la tabla usuarios de la primera fila
                
              if($tipo_usuario == "Admin") {
                 
                 $_SESSION['login_user'] = $myusername;             
                 header("location: inicio.php");
              }else {
                 $error = "El usuarios o contraseña son incorrectos";
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
      <hr>
        <form method="post" action="">     
            <label for="email">Correo</label>
            <input type="text" name="email" placeholder="Ingrese su Correo">
            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Ingrese su Contraseña">
            <input type="submit" name="Ingresar" value="Ingresar"/>
            <br>
            <a href="recuperar.php">¿Has olvidado tu contraseña?</a><br>
        </form>
    </div>
</body>
</html>