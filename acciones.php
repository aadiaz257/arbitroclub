<?php
require_once('usuarios.php');
require_once('UsuarioTorneo.php');

$accion = isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion'];

switch ($accion)
{
    case 'store_usuario':
        storeUsuario($_POST['nombre'], $_POST['apellido'], $_POST['cedula']);
        header('Location: dashboard.php');
        break;

    case 'delete_usuario':
        $resultado = deleteUsuario($_GET['id']);
        header('Location: dashboard.php?mensaje='.$resultado);
        break;

    case 'update_usuario':
        updateUsuario($_POST['id'], $_POST['nombre'], $_POST['apellido'], $_POST['cedula']);
        header('Location: dashboard.php');
        break;

    case 'store_usuario_torneo':
        storeUsuarioTorneo($_POST['usuario_id'], $_POST['torneo_id'], $_POST['cancha']);
        header('Location: cancha.php');
        break;

    case 'delete_torneo_usuario':
        deleteUsuarioTorneo($_GET['id']);
        header('Location: cancha.php');
        break;

    case 'finalizar_partido':
        updateFinalizarPartido($_GET['id'], $_GET['horas_laboradas']);
        echo '1';
        break;

    default:
        header('Location: ./');
    break;
}