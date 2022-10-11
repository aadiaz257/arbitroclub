<?php 
    include("session.php"); 
    include("usuarios.php");
    include("torneos.php");
    include("UsuarioTorneo.php");
?>
<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="img/logo.png">
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
        <div class="header">
            <h1>SISTEMA DE CONTROL ADMINISTRATIVO</h1>
        </div>
        <nav>
            <ul>
                <li class="welcome"> <h4 class="btn btn-success">Bienvenido: <?php echo  $_SESSION['login_user'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4> </li>
                <li><a href="inicio.php">INICIO</a>
                </li>
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
                    <font color="black" align="center"><h1>Registrar Procesos</h1></font><hr>
                    <form action="acciones.php" method="POST" class="col-md-10">
                          <div class="">   
                            <div class="diseno col-md-4">
                                <label for="usuario_id">Árbitro</label>
                                <select name="usuario_id" id="usuario_id" class="form-control" >
                                    <?php
                                    $usuarios = getUsuariosActivos();
                                    foreach($usuarios as $row):
                                    ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['nombre'].' '.$row['apellido'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="diseno col-md-3">
                                <label for="torneo_id">Torneos</label>
                                <select name="torneo_id" id="torneo_id" class="form-control">
                                    <?php                                    
                                    $torneos = getTorneosActivos();
                                    foreach($torneos as $row):
                                    ?>
                                    <option value="<?= $row['torneo_id'] ?>"><?= $row['nombre'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="diseno col-md-2">
                                <label for="cancha">Cancha</label>
                                <select name="cancha" id="cancha" class="form-control" >
                                    <?php
                                    for($i = 1; $i < 15; $i++):
                                        $totalcancha = countCanchas($i);
                                        if ($totalcancha < 2 ) {
                                    ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php } endfor ?>
                                </select>
                            </div>
                            <input type="hidden" name="accion" id="accion" value="store_usuario_torneo" />
                            <center><br>
                            <button type="submit" class="btn btn-danger btn-lg">Registrar</button>
                            </center>
                          </div>  
                    </form>     

                    <center>
                        <div class="card table-responsive row col-md-12" >
                        <br>
                            <table id="caddie" class="table table-striped table-hover table align-middle" id="torneo" style="font-size:75%;" >                                
                                <thead class="table-success" >
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre Torneo</th>
                                        <th>Numero de Cancha</th>
                                        <th>Árbitro</th>
                                        <th>Cédula</th>
                                        <th>Costo</th>
                                        <th>Subtotal</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Término</th>
                                        <th>Tiempo Laborado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                <tbody class="table-light">
                                <?php
                                    $usuarios_torneos = getUsuariosTorneos();
                                    foreach($usuarios_torneos as $row):
                                        $minutos_laborados = $row['horas_laboradas'] != "" ? $row['horas_laboradas'] / 60 : '';
                                        $costo = $row['costo'];
                                        $total_pagar = calcularTotalPago($minutos_laborados, $costo);
                                        $fecha_termino = $row['fecha_termino'];
                                    ?>
                                    <tr>
                                        <th><?= $row['id'] ?></th>
                                        <th><?= $row['nombre_torneo'] ?></th>
                                        <th><?= $row['cancha'] ?></th>
                                        <th><?= $row['nombre'].' '.$row['apellido'] ?></th>
                                        <th><?= $row['cedula'] ?></th>
                                        <th>$<?= $costo ?></th>
                                        <th><?= $row['horas_laboradas'] != '' ? '$'.$total_pagar : '' ?></th>
                                        <th><?= $row['fecha_inicio'] ?></th>
                                        <th><?= $fecha_termino ?></th>
                                        <th><?= segundosFormatoTiempo($row['horas_laboradas']) ?></th>
                                        <th>

                                        <?php
                                           if ($row['horas_laboradas'] == ''){   
                                        ?>       

                                            <a href="<?= $row['horas_laboradas'] == '' ? 'acciones.php?id='.$row['id'].'&accion=finalizar_partido' : '#' ?>" class="btn btn-info btn-sm finalizar_partido">Finalizar</a>
                                        
                                            <a href="<?= $row['horas_laboradas'] == '' ? 'acciones.php?id='.$row['id'].' &accion=delete_torneo_usuario' : '#' ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                         <?php
                                            }else
                                               {                                          
                                         ?>
                                         <a class="btn btn-success btn-sm">Terminado</a> <?php
                                           }
                                         ?>        
                                        </th>
                                    </tr>
                                    <?php
                                    endforeach
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </center>                    
                </center>    
            </div>     
        </div>
    </section>    
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/scripts.js"></script>
</body>
    
</html>