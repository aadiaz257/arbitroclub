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
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">     

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
                    <div class="card table-responsive col-md-12">
                        <h3>Reporte Planilla de Pagos</h3>
                        <hr>
                        <form action="listaPlanillas.php" method="POST">
                           <div class="diseno col-md-4">
                                <label for="usuario_id">Caddie</label>
                                <select name="usuario_id" id="usuario_id" class="form-control" >
                                    <option value="">Busca Caddie</option>
                                    <?php
                                    $usuarios = getUsuarios();
                                    foreach($usuarios as $row):
                                    ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['nombre'].' '.$row['apellido'] ?></option>
                                    <?php endforeach ?>
                                </select>                                
                            </div>

                           <div class="diseno col-md-4">
                                <label for="torneo_id">Torneos</label>
                                <select name="torneo_id" id="torneo_id" class="form-control">
                                    <option value="">Busca Torneo</option>
                                    <?php                                    
                                    $torneos = getTorneos();
                                    foreach($torneos as $row):
                                    ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['nombre'] ?></option>
                                    <?php endforeach ?>
                                </select>                                
                            </div>
                           <div class="diseno col-md-3 mb-3">  
                           <label for="torneo_id">Filtrar</label>                         
                            <input type="submit" value="Buscar" class="bnt btn-danger form-control">
                           </div> 
                        </form>  
                        <hr>  
                    <table id="caddie" class="table table-responsive table-condensed table-bordered table-hover display responsive nowrap" id='torneo' style="font-size:80%;">    
                        <thead class="table-success" >

                            <tr >

                                <th style='width: 5%;'  class="text-center">#</th>
                                <th style='width: 15%;'  class="">Caddie</th>
                                <th style='width: 10%;'  class="">Nombre Torneo</th>
                                <th style='width: 25%;'  class="">Fechas</th>
                                <th style='width: 10%;'  class="">Valor Hora</th>
                                <th style='width: 10%;'  class="text-center">Horas trabajadas</th>
                                <th style='width: 10%;'  class="">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                              if($_SERVER["REQUEST_METHOD"] == "POST") { 
                                    $usuario_id = $_POST['usuario_id'];
                                    $torneo_id = $_POST['torneo_id'];
                              } else{

                                    $usuario_id = "";
                                    $torneo_id = "";
                              }  
                                $i = 1;
                                $total = 0;
    
                             $planillas=getUsuariosTorneosPlanilla($usuario_id,$torneo_id,1);
                                                         
                             foreach ($planillas as $row)                               
                             { ?>
                                
                                     <tr>
                                        <td style="text-align: center;"><?php echo $i++ ?></td>

                                        <td>
                                            <p> <?php echo $row['nombre'] ?> <?php echo $row['apellido'] ?> </p>
                                        </td>
                                        <td>
                                            <p> <?php echo $row['nombre_torneo'] ?></p>
                                        </td>
                                        <td>
                                            <p> <?php echo date("M d,Y H:i A", strtotime($row['fecha_inicio'])) ?> <?php echo date("M d,Y H:i A", strtotime($row['fecha_termino'])) ?></p>
                                        </td>                                        
                                        <td>
                                            <p style="text-align: center;"> $. <?php echo ucwords($row['costo']) ?></p>
                                        </td>

                                        <td><p style="text-align: center;"><?= segundosFormatoTiempo($row['horas_laboradas']) ?></p>
                                        </td>

                                        <?php 
                                           $minutos_laborados = $row['horas_laboradas'] != "" ? $row['horas_laboradas'] / 60 : '';
                                            $costo = $row['costo'];
                                            $total_pagar = calcularTotalPago($minutos_laborados, $costo);
                                            $fecha_termino = $row['fecha_termino'];
                                      
                                            $subtotal = $total_pagar;

                                            $total += $subtotal; 
                                        ?>

                                        <td><p style="text-align: right;">$. <?= $subtotal ?> </p>              
                                        </td>   

                                    </tr>

                            <?php } ?>                        

                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="font-size: 25px;"><b>Total</b></td>
                                <td style="font-size: 25px;">    
                                <b><?php echo number_format($total, 2) ?></b>
                                </td>                                
                                <td>
                                <?php 
                                if ($usuario_id != "") {
                                       
                                ?>
                                
                                <a href="accionestorneos.php?accion=pagar_Planillas&usuario_id=<?php echo $usuario_id ?>" class="btn btn-dark url_accion">PAGAR</a>
                                <?php       
                                    }
                                  ?>      
                                </td>

                            </tr>
                        </tfoot>
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
    
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>   
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>   
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>   

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>


<script type="text/javascript">
    $('.url_accion').on('click', function(e){
      e.preventDefault();  
      let text = "Esta seguro de realizar el pago?";      
      let url = $(this).prop('href');      

      if (confirm(text) == true) {
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data){
                window.location.href = "/arbitros/listaPlanillas.php";
            }
        });        
      }
   
    });
</script>

</body>
    
</html>