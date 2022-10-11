<?php
require_once('conexion.php');

function storeUsuarioTorneo($usuario_id, $torneo_id, $cancha)
{
    $fecha_inicio = date('Y-m-d h:i:s');

    $sql = 'INSERT INTO torneos_usuarios (usuario_id, torneo_id, cancha, fecha_inicio) VALUES (:usuario_id, :torneo_id, :cancha, :fecha_inicio)';

    cambiarEstadoUsuario($usuario_id, 0);

    $query = conexion()->prepare($sql);
    $result = $query->execute([
                ':usuario_id' => $usuario_id,
                ':torneo_id' => $torneo_id,
                ':cancha' => $cancha,
                ':fecha_inicio' => $fecha_inicio
            ]);

    return $result;
}

function updateUsuarioTorneo($id, $nombre, $apellido, $cedula)
{
    $sql = 'UPDATE usuarios SET nombre = :nombre, apellido = :apellido, cedula = :cedula WHERE id = :id';

    $query = conexion()->prepare($sql);
    $result = $query->execute([
                'id' => $id,
                ':nombre' => $nombre,
                ':apellido' => $apellido,
                ':cedula' => $cedula
            ]);

    return $result;
}

function updateFinalizarPartido($id, $horas_laboradas)
{
    $torneo_usuario = getUsuarioTorneo($id);
    $fecha_inicio = $torneo_usuario['fecha_inicio'];
    $usuario_id = $torneo_usuario['usuario_id'];

    $fecha_termino = date('Y-m-d h:i:s');

    $horas_laboradas = calcularDiferenciaHoras($fecha_inicio);

    $sql = 'UPDATE torneos_usuarios SET horas_laboradas = :horas_laboradas, fecha_termino = :fecha_termino WHERE id = :id';

    $query = conexion()->prepare($sql);
    $result = $query->execute([
                'id' => $id,
                ':horas_laboradas' => $horas_laboradas,
                ':fecha_termino' => $fecha_termino
            ]);

    cambiarEstadoUsuario($usuario_id, 1);

    return $result;
}

function getUsuariosTorneos()
{
    $sql = 'SELECT
                torneos_usuarios.id,
                usuarios.nombre,
                usuarios.apellido,
                usuarios.cedula,
                torneos.nombre AS nombre_torneo,
                torneos_usuarios.fecha_inicio,
                torneos_usuarios.fecha_termino,
                torneos_usuarios.horas_laboradas,
                torneos.costo,
                torneos_usuarios.cancha
            FROM
                torneos_usuarios
                INNER JOIN torneos ON torneos_usuarios.torneo_id = torneos.id
                INNER JOIN usuarios ON torneos_usuarios.usuario_id = usuarios.id WHERE torneos_usuarios.estado = 1';
                

    $query = conexion()->query($sql);

    return $query;
}

function getUsuariosTorneosPlanilla($usuario_id = '', $torneo_id = '', $estado = 1 )
{

    if($usuario_id != '' && $torneo_id == '')
    {
        $condicion = 'WHERE torneos_usuarios.estado = '.$estado.' AND torneos_usuarios.usuario_id = '.$usuario_id;
    }
    elseif($usuario_id == '' && $torneo_id != '')
    {
        $condicion = 'WHERE torneos_usuarios.estado = '.$estado.' AND torneos_usuarios.torneo_id = '.$torneo_id;
    }
    elseif($usuario_id != '' && $torneo_id != '')
    {
        $condicion = 'WHERE torneos_usuarios.estado = '.$estado.' AND torneos_usuarios.torneo_id = '.$torneo_id.' AND torneos_usuarios.usuario_id = '.$usuario_id;
    }
    else
    {
        $condicion = 'WHERE torneos_usuarios.estado = '.$estado.'';
    }

    $sql = 'SELECT
                torneos_usuarios.id,
                usuarios.id AS usuario_id,
                usuarios.nombre,
                usuarios.apellido,
                usuarios.cedula,
                torneos.nombre AS nombre_torneo,
                torneos_usuarios.fecha_inicio,
                torneos_usuarios.fecha_termino,
                torneos_usuarios.horas_laboradas,
                torneos.costo,
                torneos_usuarios.cancha
            FROM
                torneos_usuarios
                INNER JOIN torneos ON torneos_usuarios.torneo_id = torneos.id
                INNER JOIN usuarios ON torneos_usuarios.usuario_id = usuarios.id '.$condicion;

    $query = conexion()->query($sql);

    return $query;
}

function getUsuarioTorneo($id)
{
    $sql = 'SELECT * FROM torneos_usuarios WHERE id = :id';

    $query = conexion()->prepare($sql);
    $query->execute([
                ':id' => $id
            ]);
    $result = $query->fetch();

    return $result;
}

function deleteUsuarioTorneo($id)
{
    $torneo_usuario = getUsuarioTorneo($id);
    $usuario_id = $torneo_usuario['usuario_id'];

    $sql = 'DELETE FROM torneos_usuarios WHERE id = :id';

    $query = conexion()->prepare($sql);
    $result = $query->execute([
                ':id' => $id
            ]);

    cambiarEstadoUsuario($usuario_id, 1);

    return $result;
}

function calcularDiferenciaHoras($fecha_inicio)
{
    $fecha_actual = date('Y-m-d h:i:s');
    $segundos = strtotime($fecha_actual) - strtotime($fecha_inicio);

    return $segundos;
    /* $date1 = new DateTime($fecha_inicio);
    $date2 = new DateTime("now");
    $diff = $date1->diff($date2);

    return ( ($diff->days * 24 ) * 60 ) + ( $diff->i * 60 ) + $diff->s; */
    // passed means if its negative and to go means if its positive
    //echo ($diff->invert == 1 ) ? ' passed ' : ' to go ';
}

function segundosFormatoTiempo($tiempo_en_segundos)
{
    if($tiempo_en_segundos > 0)
    {
        $horas = floor($tiempo_en_segundos / 3600);
        $minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
        $segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);

        $hora_texto = "";

        if ($horas > 0 ) {
            $hora_texto .= $horas . "h ";
        }

        if ($minutos > 0 ) {
            $hora_texto .= $minutos . "m ";
        }

        if ($segundos > 0 ) {
            $hora_texto .= $segundos . "s";
        }
    }
    else
    {
        $hora_texto = '';
    }

    return $hora_texto;
}

function calcularTotalPago($tiempo_minutos, $costo_hora)
{
    if($tiempo_minutos <= 60)
    {
        $total_pagar = $costo_hora;
    }
    else if($tiempo_minutos > 60)
    {
        $costo_minuto = round($costo_hora / 60, 2);
        $total_pagar = round($costo_minuto * $tiempo_minutos, 2);
    }
    else
    {
        $total_pagar = '';
    }

    return $total_pagar;
}

function reportesPlanillaPagos()
{
    $sql = 'SELECT
                torneos_usuarios.id,
                usuarios.nombre,
                usuarios.apellido,
                usuarios.cedula,
                torneos.nombre AS nombre_torneo,
                torneos_usuarios.fecha_inicio,
                torneos_usuarios.fecha_termino,
                torneos_usuarios.horas_laboradas,
                torneos.costo,
                torneos_usuarios.cancha
            FROM
                torneos_usuarios
                INNER JOIN torneos ON torneos_usuarios.torneo_id = torneos.id
                INNER JOIN usuarios ON torneos_usuarios.usuario_id = usuarios.id ';
                

    $query = conexion()->query($sql);

    return $query;
}

function pagarPlanillas($usuario_id)
{
    
    $sql = 'UPDATE torneos_usuarios SET estado = 0 WHERE usuario_id = :usuario_id';
     
    $query = conexion()->prepare($sql);
    $result = $query->execute([
                'usuario_id' => $usuario_id    
            ]);

    return $result;

}