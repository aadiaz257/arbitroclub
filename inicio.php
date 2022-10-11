<?php 
    include("session.php"); 
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
	    <h1>Bienvenidos al Sistema</h1>
	    <hr>
        <img src="image/logo2.png" alt="logo" height="250px" width= "250px">
        <hr>
	</section>
    
</body>
</html>