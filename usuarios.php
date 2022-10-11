<?php
require_once('conexion.php');

function storeUsuario($nombre, $apellido, $cedula, $tipo_usuario = 'Arbitro')
{
    $sql = 'INSERT INTO usuarios (nombre, apellido, cedula, tipo_usuario, estado) VALUES (:nombre, :apellido, :cedula, :tipo_usuario, :estado)';

    $query = conexion()->prepare($sql);
    $result = $query->execute([
                ':nombre' => $nombre,
                ':apellido' => $apellido,
                ':cedula' => $cedula,
                ':tipo_usuario' => $tipo_usuario,
                ':estado' => 1
            ]);

    return $result;
}

function updateUsuario($id, $nombre, $apellido, $cedula)
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


function getUsuarios()
{
    $sql = 'SELECT * FROM usuarios WHERE tipo_usuario = "Arbitro"';
    $query = conexion()->query($sql);

    return $query;
}

function getUsuariosActivos()
{
    $sql = 'SELECT * FROM usuarios WHERE tipo_usuario = "Arbitro" AND estado = :estado';

    $query = conexion()->prepare($sql);
    $query->execute([
                ':estado' => 1
            ]);

    return $query;
}

function getUsuario($id)
{
    $sql = 'SELECT * FROM usuarios WHERE id = :id';

    $query = conexion()->prepare($sql);
    $query->execute([
                ':id' => $id
            ]);
    $result = $query->fetch();

    return $result;
}

function deleteUsuario($id)
{

    $totalRelacion = getCountRelaciones($id);
    $result = "No se puede Eliminar, tiene Registros!";

    if ($totalRelacion == 0) {
    
        $sql = 'DELETE FROM usuarios WHERE id = :id';

        $query = conexion()->prepare($sql);
        $result = "Registro Eliminado " .$query->execute([
                    ':id' => $id
                ]);

    }
        return $result;

}

function getCountRelaciones($usuario_id)
{
    $sql = 'SELECT id FROM torneos_usuarios WHERE usuario_id = :usuario_id';

 
    $query = conexion()->prepare($sql);
    $query->execute([
                  ':usuario_id' => $usuario_id
         ]);
    $existeUser = $query->rowCount();

    return $existeUser;
}



function cambiarEstadoUsuario($usuario_id, $estado)
{
    $sql = 'UPDATE usuarios SET estado = :estado WHERE id = :id';

    $query = conexion()->prepare($sql);
    $result = $query->execute([
                'id' => $usuario_id,
                ':estado' => $estado
            ]);

    return $result;
}