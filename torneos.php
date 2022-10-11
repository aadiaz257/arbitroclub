<?php
require_once('conexion.php');

function storeTorneo($nombre, $inicio, $termino, $costo)
{
    $sql = 'INSERT INTO torneos (nombre, inicio, termino, costo, estado) VALUES (:nombre, :inicio, :termino, :costo, :estado)';

    $query = conexion()->prepare($sql);
    $result = $query->execute([
                ':nombre' => $nombre,
                ':inicio' => $inicio,
                ':termino' => $termino,
                ':costo' => $costo,
                ':estado' => 1
            ]);

    return $result;
}

function updateTorneo($id, $nombre, $inicio, $termino, $costo)
{
    $sql = 'UPDATE torneos SET nombre = :nombre, inicio = :inicio, termino = :termino, costo = :costo WHERE id = :id';

    $query = conexion()->prepare($sql);
    $result = $query->execute([
                'id' => $id,
                ':nombre' => $nombre,
                ':inicio' => $inicio,
                ':termino' => $termino,
                ':costo' => $costo
            ]);

    return $result;
}

function getTorneos()
{
    $sql = 'SELECT * FROM torneos';
    $query = conexion()->query($sql);

    return $query;
}

function countCanchas($cancha)
{

    $sql = 'SELECT id FROM torneos_usuarios WHERE cancha = :cancha AND ISNULL(fecha_termino) ';

    $query = conexion()->prepare($sql);
    $query->execute([
                  ':cancha' => $cancha
         ]);
    $existeCancha = $query->rowCount();

    return $existeCancha;

}

function getTorneosActivos()
{
    $torneos = getTorneos();

    $registros = [];
    foreach($torneos as $row)
    {
        $torneo_id = $row['id'];
        $nombre = $row['nombre'];

        $sql1 = 'SELECT
                   id
                FROM
                    torneos_usuarios
                WHERE
                    torneo_id = :torneo_id
                AND
                    ISNULL(fecha_termino)';

        $query1 = conexion()->prepare($sql1);
        $query1->execute([
                    ':torneo_id' => $torneo_id
                ]);
        $torneo_activo = $query1->rowCount();


        if($torneo_activo < 10){
            $registros[] = [
                'torneo_id' => $torneo_id,
                'nombre' => $nombre,
                'activo' => $torneo_activo
            ];
        }
    }

    return $registros;
}

function getTorneo($id)
{
    $sql = 'SELECT * FROM torneos WHERE id = :id';

    $query = conexion()->prepare($sql);
    $query->execute([
                ':id' => $id
            ]);
    $result = $query->fetch();

    return $result;
}

function deleteTorneo($id)
{

    $totalRelacionTorneo = getCountRelacionesTorneo($id);
    $result = "No se puede Eliminar, tiene Registros!";

    if ($totalRelacionTorneo == 0) {
    
        $sql = 'DELETE FROM torneos WHERE id = :id';

        $query = conexion()->prepare($sql);
        $result = "Registro Eliminado " .$query->execute([
                    ':id' => $id
                ]);

    }
        return $result;
}

function getCountRelacionesTorneo($torneo_id)
{
    $sql = 'SELECT id FROM torneos_usuarios WHERE torneo_id = :torneo_id';

    $query = conexion()->prepare($sql);
    $query->execute([
                  ':torneo_id' => $torneo_id
         ]);
    $existeTorneo = $query->rowCount();

    return $existeTorneo;
}