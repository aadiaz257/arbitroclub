<?php 
    include("session.php"); 
    include("torneos.php");  
    
    if(isset($_GET['id']))
    {
        $torneo = getTorneo($_GET['id']);
        $id = $torneo['id'];
        $nombre = $torneo['nombre'];
        $inicio = $torneo['inicio'];
        $termino = $torneo['termino'];
        $costo = $torneo['costo'];        
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
                            <font color="black" align="center"><h1>Editar Torneo: <?php echo $nombre; ?></h1></font><hr>
                                <form action="accionestorneos.php" method="POST" class="col-md-12">

                                    <div class="diseno col-md-3">
                                        <input type="text" class="form-control mb-3" name="nombre" id="nombre" placeholder="Nombre" value="<?= isset($_GET['id']) ? $nombre : '' ?>">
                                    </div>
                                    <div class="diseno col-md-2">
                                        <input type="date" class="form-control mb-3" name="inicio" id="inicio" placeholder="Fecha Inicio" value="<?= isset($_GET['id']) ? $inicio : '' ?>">
                                    </div>
                                    <div class="diseno col-md-2">
                                        <input type="date" class="form-control mb-3" name="termino" id="termino" placeholder="Fecha Final" value="<?= isset($_GET['id']) ? $termino : '' ?>">
                                    </div>                                    
                                    <div class="diseno col-md-2">
                                        <input type="text" class="form-control mb-3" name="costo" id="costo" placeholder="Valor Arbitraje" value="<?= isset($_GET['id']) ? $costo : '' ?>">
                                    </div>
                                    <input type="hidden" name="accion" id="accion" value="<?= isset($_GET['id']) ? 'update_torneo' : 'store_torneo' ?>" />
                                    <input type="hidden" name="id" id="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />
                                    <center><input type="submit" value="Guardar"class="btn btn-warning btn-lg"></center>
                                </form>
                                
                        </center>
                        <center><div class="card table-responsive row col-md-10">
                        <br>
                            <table class=" table table-striped table-hover table align-middle" id="caddie">
                    			<colgroup>
									<col width="5%">
									<col width="20%">
									<col width="15%">
									<col width="15%">
									<col width="10%">									
									<col width="20%">
								</colgroup>
                                <thead class="table-warning" >
                                    <tr>
                                        <th scope="col">Nro</th>
                                        <th scope="col">Nombre Torneo</th>
                                        <th scope="col">Fecha Inicio</th>
                                        <th scope="col">Fecha Final</th>
                                        <th scope="col">Costo Arbitraje</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $torneos = getTorneos();
                                    $i=1;
                                    foreach($torneos as $row):
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <th scope="row"><?= $row['nombre']?></th>
                                        <th scope="row"><?= $row['inicio']?></th>
                                        <th scope="row"><?= $row['termino']?></th>
                                        <th scope="row"><?= $row['costo']?></th>    
                                        <th scope="row"><a href="editatorneo.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                        	<!-- <a href="accionestorneos.php?id=<?= $row['id'] ?>&accion=delete_torneo" class="btn btn-danger">Eliminar</a>
                                            -->   
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