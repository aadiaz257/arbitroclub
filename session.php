<?php
   include('conexion.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $sql = "SELECT email from usuarios where email = :email";

    $query = conexion()->prepare($sql);
    $query->execute([
                ':email' => $user_check
            ]);
    $result = $query->fetch();

   $login_session = $result['email'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>