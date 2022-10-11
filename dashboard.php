<?php 
    include("session.php"); 
    include("usuarios.php");          
    
    if(isset($_GET['id']))
    {
        $usuario = getUsuario($_GET['id']);
        $id = $usuario['id'];
        $nombre = $usuario['nombre'];
        $apellido = $usuario['apellido'];
        $cedula = $usuario['cedula'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    

    
</head>
<body style="text-align: center; background-image: url(image/fondo.png);">
<header>
		<div class="header" >
			<h1>SISTEMA DE CONTROL ADMINISTRATIVO</h1>
		</div>
		<nav>
			<ul>
                <li class="welcome"> <h4 class="btn btn-success">Bienvenido: <?php echo  $_SESSION['login_user'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4> </li>
				<li><a href="inicio.php">INICIO</a></li>
				<li class="principal">
					<a href="#">CADIES</a>
					<ul>
						<li><a href="dashboard.php">Registrar Cadies</a></li>					
					</ul>
				</li>
                <li class="principal">
                    <a href="#">TORNEOS</a>
                    <ul>
                        <li><a href="registrotorneo.php">Registrar Torneo</a></li>
                    </ul>
                </li>
				<li class="principal">
					<a href="#">PROCESOS</a>
					<ul>
						<li><a href="cancha.php">Registro de canchas</a></li>
					</ul>
				</li>			
				<li class="principal">
                    <a href="#">PLANILLAS</a>
                    <ul>
                        <li><a href="listaPlanillas.php">Planillas por Pagar</a>
                        </li>
                        <li><a href="pagosPlanillas.php">Planillas Pagadas</a>
                        </li>
                    </ul>
                </li>
				<li class="aprincipal" >
					<a href="#" >Salir</a>
					<ul>
						<li><a href = "logout.php">Cerrar Sesion</a></li>
					</ul>
				</li>

			</ul>
		</nav>
	</header>
	<section id="container">
		
            <div class="container">
                    <div class="row"> 
                        <center>
                            <font color="black" align="center"><h1>Registrar Cadies</h1></font><hr>
                                <form action="acciones.php" method="POST" class="col-md-12">

                                    <div class="diseno col-md-4">
                                        <input type="text" class="form-control mb-3" name="cedula" id="cedula" placeholder="Cedula" value="<?= isset($_GET['id']) ? $cedula : '' ?>">
                                    </div>
                                    <div class="diseno col-md-4">
                                        <input type="text" class="form-control mb-3" name="nombre" id="nombre" placeholder="Nombres" value="<?= isset($_GET['id']) ? $nombre : '' ?>">
                                    </div>
                                    <div class="diseno col-md-3">
                                        <input type="text" class="form-control mb-3" name="apellido" id="apellido" placeholder="Apellidos" value="<?= isset($_GET['id']) ? $apellido : '' ?>">
                                    </div>
                                    <input type="hidden" name="accion" id="accion" value="<?= isset($_GET['id']) ? 'update_usuario' : 'store_usuario' ?>" />
                                    <input type="hidden" name="id" id="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />
                                    <center><input type="submit" value="Registrar Caddie"class="btn btn-success btn-lg"><br>
                                    </center>
                                </form>
                                <br>
                        </center>
                        <center><div class="card table-responsive row col-md-10">
                        <br>
                        <?php if (isset($_GET['mensaje'])) {
                            $message =  $_GET['mensaje'];
                            echo "<font color='red'>".$message."</font>";

                        } ?>
                        
                            <table class=" table table-striped table-hover table align-middle" id="caddie" >
                    			<colgroup>
									<col width="10%">
									<col width="15%">
									<col width="15%">
									<col width="15%">
									<col width="20%">
								</colgroup>
                                <thead class="table-success" >
                                    <tr>
                                        <th scope="col">Nro</th>
                                        <th scope="col">Cedula</th>
                                        <th scope="col">Nombres</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $usuarios = getUsuarios();
                                    $i=1;
                                    foreach($usuarios as $row):
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <th scope="row"><?= $row['cedula']?></th>
                                        <th scope="row"><?= $row['nombre']?></th>
                                        <th scope="row"><?= $row['apellido']?></th>    
                                        <th scope="row"><a href="editauser.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                        	<a href="acciones.php?id=<?= $row['id'] ?>&accion=delete_usuario" class="btn btn-danger btn-sm">Eliminar</a>                                 
                                    	</th>                                        
                                    </tr>

                                    <?php $i=$i+1; endforeach  ?>
                                </tbody>
                            </table>
                        </div>
                    </center>
                    </div>  
            </div>
	</section>
	
	
	
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="js/scripts.js"></script>	

</body>
</html>