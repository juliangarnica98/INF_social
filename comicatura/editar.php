<?php

session_start();
require 'lib/errores.php';
require 'lib/config.php';
require 'lib/validarfoto.php';
spl_autoload_register(function($clase){
    require_once "lib/$clase.php";
});
if( !$_SESSION['idUsuario'] && !$_SESSION['nombre'] && !$_SESSION['rol']){
    header("Location: index.php");
    exit;
}

if( $_SESSION['rol']=='estudiante'){
    header("Location: admin.php");
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
       <?php if(isset($_GET['editar'])): ?>
       <div class="row">
           <div class="col-sm-6">
              
              <?php
                $eID=$_GET['editar'];
                $db->preparar("SELECT nombre,email,telefono,direccion,edad FROM usuarios WHERE idUsuario =?");
                $db->prep()->bind_param('i', $eID);
                $db->ejecutar();
                $db->prep()->bind_result($enombre,$eemail,$etelefono,$edireccion,$eedad);
                $db->resultado();
                $db->liberar();
               ?>
               <form action="actualizar.php" enctype="multipart/form-data" method="POST" role="form">
                    <legend>Editar</legend>

                                     
                    <div class="form-group">
                        <input name="nombre" type="hidden" class="form-control" value="<?php echo $enombre; ?>" >
                    </div>
                    <div class="form-group">
                        <input name="email" type="text" class="form-control" id="" placeholder="<?php echo $eemail; ?>">
                    </div>
                    <div class="form-group">
                        <input name="contrasena" type="password" class="form-control" id="" placeholder="Contraseña">
                    </div>  
                    <div class="form-group">
                        <input name="confircontrasena" type="password" class="form-control" id="" placeholder="Confirmar contraseña">
                    </div>  
                    
                    <div class="form-group">
                        <input name="telefono" type="text" class="form-control" id="" placeholder="<?php echo $etelefono; ?>">
                    </div>
                    <div class="form-group">
                        <input name="direccion" type="text" class="form-control" id="" placeholder="<?php echo $edireccion; ?>">
                    </div>
                    <div class="form-group">
                        <input name="edad" type="text" class="form-control" id="" placeholder="<?php echo $eedad; ?>">
                    </div>
                    <div class="form-group">
                        <input name="id" type="hidden" class="form-control" value="<?php echo $eID ?>;">
                    </div>
                   
                    <div class="form-group">
                        <label for="">Escoja su foto de perfil</label>
                        <input name="imagen" type="file" class="form-control" id="" >
                    </div>                 
                    


                    <button type="submit" class="btn btn-warning">Actualizar</button>
                    
                </form>
           </div>
       </div>
       
       <?php elseif($_GET['confireliminar']):?>
       <div class="row justify-content-center">
           <div class="col-sm-5">
              <div class="caja text-center">
                  <h2>¿Esta seguro de eliminarlo?</h2>
                   <a class="btn btn-danger" href='<?php echo "editar.php?eliminar={$_GET['confireliminar']}"?>'>Si</a>
                   <a class="btn btn-info" href="editar.php">No</a>
              </div>
           </div>
       </div>
       
       <?php elseif($_GET['eliminar']):?>
       <div class="row justify-content-center">
           <div class="col-sm-5">
              <div class="caja text-center">
               <?php
                  
                $eID=$_GET['eliminar'];
                  
                $db->preparar("SELECT nombre FROM usuarios WHERE idUsuario =?");
                $db->prep()->bind_param('i', $eID);
                $db->ejecutar();
                $db->prep()->bind_result($name);
                $db->resultado();              
                $db->liberar();
                  
                  
                $db->preparar("DELETE FROM usuarios WHERE idUsuario =?");
                $db->prep()->bind_param('i', $eID);
                $db->ejecutar();
                if( $db->filaAfecta()>0){
                    echo "Eliminacion exitosa<br>";
                    echo $db->filaAfecta();
                    
                    header("Refresh:5; url=editar.php"); 
                    borrarCarpeta("fotos/$name");
                }
                $db->liberar();
               ?>
              </div>
           </div>
       </div>
       
       <?php else: ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="caja">
                    <div class="caja-cabecera">
                        <span> <i class="fas fa-users"></i>Edita o elimina algun usuario </span>
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
                                    <th>Modificacion</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                
                               $db->preparar("SELECT COUNT(idUsuario) FROM usuarios ");
                               $db->ejecutar();
                               $db->prep()->bind_result($contador);
                               $db->resultado();
                               $db->liberar();
                               $porpagina=4;   
                               $paginas=ceil($contador/$porpagina);
                               $pagina=(isset($_GET['pagina']))?(int)$_GET['pagina'] :1;
                               $iniciar=($pagina-1)*$porpagina;
                            
                                
                                
                                $db->preparar("SELECT idUsuario, CONCAT(nombre,' ',apellido) AS nombrecompleto, email, cedula, telefono, direccion, edad, ciudad, departamento, fecha FROM usuarios ORDER BY fecha LIMIT $iniciar, $porpagina ");
                                $db->ejecutar();
                               $db->prep()->bind_result($dbid,$dbnombrecompleto,$dbemail,$dbcedula,$dbtelefono,$dbdireccion,$dbedad,$dbciudad,$dbdepartamento,$dbfecha);
                                
                                 $conteo=$iniciar;
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
                                            <td>  
                                            <a class='btn btn-success ' href='editar.php?editar=$dbid' style='width: 27px; height: 26px; font-size: 10px; padding: 5px;'>
                                            <i class='fas fa-edit'></i>
                                            </a> 
                                            <a class='btn btn-danger ' href='editar.php?confireliminar=$dbid' style='width: 27px; height: 26px; font-size: 10px; padding: 5px;'>
                                            <i class='fas fa-trash-alt'></i></a> 
                                            </td>
                                        </tr>";
                                }
                                $db->liberar();
                                ?>
                                
                            </tbody>
                        </table>
                        <?php
                        $anterior=($pagina-1);
                        $siguiente=($pagina+1);
                        ?>
                        <nav aria-label="Page navigation example">
                          <ul class="pagination">
                           <?php if(!($pagina<=1)):?>
                            <li class="page-item">
                              <a class="page-link" href='<?php echo "?pagina=$anterior"?>' aria-label="anterior">
                                <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>
                            <?php endif; ?>
                            
                            <?php
                              if($paginas>=1){
                                  for($x=1;$x<=$paginas;$x++){
                                        echo ($x==$pagina)?"<li class='active'><a class='page-link' href='$pagina=$x'>$x</a></li>" : "<li class=''><a class='page-link' href='$pagina=$x'>$x</a></li>";       
                                  }
                                  
                              }  
                              
                            ?>
                            
                            <?php if(!($pagina>=$paginas)):?>
                            <li class="page-item">
                              <a class="page-link" href='<?php echo "?pagina=$siguiente"?>' aria-label="siguiente">
                                <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li>
                            <?php endif; ?>
                          </ul>
                        </nav>
                        
                    </div>
                </div>
            </div>
        </div>
   
        <?php endif; ?>
    </div>
    <?php endif; ?>
  </div>
 
    <!--
                
else:
            header('Location: ../index.php');
                
-->
    

<?php require 'inc/footer.inc'; ?>