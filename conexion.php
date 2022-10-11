<?php
    date_default_timezone_set('America/Mexico_city');

    define('DB_HOST', 'localhost');
    define('DB_PORT', 3306);
    define('DB_NAME', 'torneos');
    define('DB_USER', 'root');
    define('DB_PASS', '');

    function conexion()
    {
        try
        {
            $conexion = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME, DB_USER, DB_PASS,array(
                PDO::ATTR_DEFAULT_FETCH_MODE =>PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            ));

            return $conexion;
        } 
        catch(PDOException $e)
        {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }