<?php
require_once('conexion.php');

function getLogin($myusername,$mypassword)
{
  
	$sql = "SELECT tipo_usuario FROM usuarios WHERE email = :email and password = :password";

    $query = conexion()->prepare($sql);
    $query->execute([
                ':email' => $myusername,
                ':password' => md5($mypassword)
            ]);

    $result = $query->fetch();

    return $result;
}

function countUsuario($myusername,$mypassword)
{
	$sql = "SELECT tipo_usuario FROM usuarios WHERE email = :email and password = :password";

    $query = conexion()->prepare($sql);
    $query->execute([
                ':email' => $myusername,
                ':password' => md5($mypassword)
            ]);

    $result = $query->rowCount();

    return $result;
}

function buscar($myusername,$mypassword)
{
  
    $sql = "SELECT tipo_usuario FROM usuarios WHERE email = :email and password = :password";

    $query = conexion()->prepare($sql);
    $query->execute([
                ':email' => $myusername,
                ':password' => md5($mypassword)
            ]);

    $result = $query->fetch();

    return $result;
}