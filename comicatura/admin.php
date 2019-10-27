<?php

session_start();
require 'lib/errores.php';
require 'lib/config.php';
spl_autoload_register(function($clase){
    require_once "lib/$clase.php";
});
if( !$_SESSION['idUsuario'] && !$_SESSION['nombre'] && !$_SESSION['rol'] ){
    header("Location: index.php");
    exit;
}
$fecha=getdate();
$diaN=date('d');
$anio=date('y');
$meses=["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
$dias=["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"];
$dia2=$dias[$fecha['wday']];
$mes=$meses[$fecha['mon']-1];

$db = new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);

$db->preparar("SELECT  CONCAT(nombre,' ',apellido) AS nombrecompleto, imagen FROM usuarios WHERE idUsuario =?");
$db->prep()->bind_param('i', $_SESSION['idUsuario']);
$db->ejecutar();
$db->prep()->bind_result($uNombre,$uImagen);
$db->resultado();
$db->liberar();

$db->preparar("SELECT CONCAT(nombre,' ',apellido) AS nombrecompleto, email, cedula, telefono, direccion, edad, ciudad, departamento, fecha FROM usuarios ORDER BY fecha LIMIT 10 ");
$db->ejecutar();
$db->prep()->bind_result($dbnombrecompleto,$dbemail,$dbcedula,$dbtelefono,$dbdireccion,$dbedad,$dbciudad,$dbdepartamento,$dbfecha);



?>

<?php require 'inc/cabecera.inc'; ?>


  <div class="izq">
      <div class="perfil">
          
            <img class="rounded-circle float-right img-responsive " src='<?php echo $uImagen ;?>' alt="">
      </div>
      <div class="nombre">
          <h4 class="text-center"> <?php echo ucwords($uNombre);?></h4>
      </div>
  </div>
  <div class="der">
     <?php if($_SESSION['rol']==profesor): ?>
      <div class="cabecera-pag">
          <h1 class="titulo-pag">
             Administracion
                  <small>Bienvenido a la administracion del portal</small>
              
          </h1>
          <div class="fecha float-right">
             <i class="fas fa-calendar-alt"></i>
                <span><?php echo "$mes $diaN, 20$anio - $dia2"?></span>
          </div>
      </div>
       <div class="container-fluid " >
        <div class="row d-flex justify-content-center" >
          
           <div class="col-lg-3 col-md-3 col-ms-6 col-xs-12 " >
               <div class="panel">
                   <div class="icono bg-ama">
                       <i class="fas fa-users"></i>
                   </div>
                   <div class="valor">
                       <h1 class="cantidad">#</h1>
                       <p>Usuarios</p>
                   </div>
                   
               </div>              
           </div>
          
            

        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="caja">
                    <div class="caja-cabecera">
                        <span>Ultimos usuarios registrados</span>
                    </div>
                    
                    <div class="caja-cuerpo">
                        <table class="table table-sm ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Cedula</th>
                                    <th>Telefono</th>
                                    <th>Direccion</th>
                                    <th>Edad</th>
                                    <th>Ciudad</th>    
                                    <th>Departamento</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                 $conteo=0;
                                 while($db->resultado()){
                                    $conteo++;
                                    echo "<tr>
                                            <td>$conteo</td>
                                            <td>$dbnombrecompleto</td>
                                            <td>$dbemail</td>
                                            <td>$dbcedula</td>
                                            <td>$dbtelefono</td>
                                            <td>$dbdireccion</td>
                                            <td>$dbedad</td>
                                            <td>$dbciudad</td>
                                            <td>$dbdepartamento</td>
                                            
                                            <td>".date('d/m/y',$dbfecha)."</td>
                                        </tr>";
                                }
                                
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
   
        
    </div>
    <?php endif; ?>
  </div>
 
    <!--
                
else:
            header('Location: ../index.php');
                
-->
    

<?php require 'inc/footer.inc'; ?>