<?php
require_once('torneos.php');
require_once('UsuarioTorneo.php');

$accion = isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion'];

switch ($accion)
{
    case 'store_torneo':
        storeTorneo($_POST['nombre'], $_POST['inicio'], $_POST['termino'], $_POST['costo']);
        header('Location: registrotorneo.php');
        break;

    case 'delete_torneo':
        $resultado = deleteTorneo($_GET['id']);
        header('Location: registrotorneo.php?mensaje='.$resultado);
        break;

    case 'update_torneo':
        updateTorneo($_POST['id'], $_POST['nombre'], $_POST['inicio'], $_POST['termino'], $_POST['costo']);
        header('Location: registrotorneo.php');
        break;

    case 'store_torneo_torneo':
        storeUsuarioTorneo($_POST['usuario_id'], $_POST['torneo_id'], $_POST['cancha']);
        header('Location: cancha.php');
        break;

    case 'delete_torneo_torneo':
        deleteUsuarioTorneo($_GET['id']);
        header('Location: cancha.php');
        break;

    case 'finalizar_partido':
        updateFinalizarPartido($_GET['id'], $_GET['horas_laboradas']);
        echo '1';
        break;

    case 'pagar_Planillas':
        return pagarPlanillas($_GET['usuario_id']);                
        break;        

    default:
        header('Location: ./');
    break;
}