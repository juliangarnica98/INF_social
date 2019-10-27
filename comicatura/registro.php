<?php require 'inc/cabecera.inc'; ?>
<div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-centrar">
<?php 
                require_once 'lib/config.php';
                require 'lib/errores.php';
                require 'lib/validarfoto.php';
                spl_autoload_register(function($clase){
                    require_once "lib/$clase.php";
                });
                
                if( $_POST){
                    
                    //convirtiendo array en variables
                    extract( $_POST, EXTR_OVERWRITE);
                    if(!file_exists("fotos")){
                        mkdir("fotos",0777);
                    }
                    $nombre = strtolower($nombre);

                    if($nombre && $email && $contrasena && $confircontrasena){
                        
                        $db = new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                        
                        $expreg='/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/ ';
                        if(preg_match($expreg,$email)){
                            if(strlen($contrasena)>5){
                                if($contrasena==$confircontrasena){
                                    $validaremail = $db->validarDatos('email','usuarios',$email);
                                    //echo "$validaremail ";
                                    if($validaremail==0){
                                        if(validarFoto($nombre,$apellido)){
                                         //   echo "<img class='img-responsive ' src='$rutaSubida'>";
                                            $fecha=time();
                                            $rol='estudiante';
                                        
                                            if($db->preparar("INSERT INTO usuarios VALUES(NULL,'$nombre','$apellido','$email','$contrasena',$cedula,$telefono,'$direccion',$edad,'$ciudad','$departamento',$codigo,'$rutaSubida',$fecha,$rol)")){
                                                $db->ejecutar();
                                                trigger_error("Te has registrado exitosamente",E_USER_NOTICE);
                                                $ok=true;
                                            }
                                        }else{
                                            echo $error;
                                        }
                                    }else{
                                       trigger_error("El correo ya existe",E_USER_ERROR);
                                    }
                                }else{
                                    trigger_error("Las contraseñas no coinciden",E_USER_ERROR);
                                    
                                }
                            }else{
                                trigger_error("La contraseña debe ser mayor a 5 caracteres",E_USER_ERROR);
                             
                            }
                        }else{
                            trigger_error("Debe ingresar un correo valido",E_USER_ERROR);
                            
                        }
                    }
                }
                //trigger_error("Error al preparar la consulta",E_USER_ERROR);
                
//                $array = $db->getClientes();
//                
//                echo"<table class='table table-cell'>
//                        <thead>
//                            <tr>
//                                <td>id</td>
//                                <td>nombre</td>
//                                <td>apellido</td>
//                                <td>email</td>
//                                <td>contraseña</td>
//                                <td>cedula</td>
//                                <td>telefono</td>
//                                <td>direccion</td>
//                                <td>edad</td>
//                                <td>ciudad</td>
//                                <td>departamento</td>
//                                <td>id</td>
//                            </tr>
//                            <tbody>
//                ";
//                foreach($array as $v){
//                    echo "<tr>";
//                    foreach ($v as $v2){
//                        echo "<td>$v2</td>";
//                    }
//                    echo "</tr>";
//                }
//                echo "</tbody>
//                    </table>";
                //var_dump($array);
                
                
//           
//                $db->preparar("SELECT nombre,apellido,email,cedula FROM usuarios");
//                $db->ejecutar();
//                $db->prep()->bind_result($nombre,$apellido,$email,$cedula);
//                echo"<table class='table table-cell'>
//                        <thead>
//                            <tr>
//                                
//                                <td>nombre</td>
//                                <td>apellido</td>
//                                <td>email</td>
//                                <td>Cedula</td>
//                               
//                            </tr>
//                            <tbody>
//                ";
//                while($db->resultado()){
//                    echo "<tr>
//                            <td>$nombre</td>
//                            <td>$apellido</td>
//                            <td>$email</td>
//                            <td>$cedula</td>
//                        </tr>";
//                }
//                echo "</tbody>
//                    </table>";
//                
//                echo $db->validarDatos('ciudad','usuarios','bogota');
//                //var_dump($array);
?>
            </div>
        </div>
    </div>    
    <div class="container-fluid">
        <div class="row">
           <div class="col-md-12 text-center">
               <a class="navbar-brand text-warning ml-5 " href="index.php" style="font-size:30px;">Comicaruta</a>
           </div>
        </div>
        
          <div class="row">  
            <div class="col-md-6 col-centrar">
             
             
                <?php if($ok): ?>
                    <h2>Hola <?php echo $nombre ?></h2>
                    <img class="img-responsive" src="<?php echo $rutaSubida; ?>" alt="">
                    <p>Te has registrado correctamente, por favor dirigete a la pagina principal para iniciar sesion</p>
                    <a class="btn btn-warning" href="index.php">pagina principal</a>
                <?php else: ?>  

                <form action="" enctype="multipart/form-data" method="POST" role="form">
                    <legend>Registrarse</legend>

                                     
                    <div class="form-group">
                        <input name="nombre" type="text" class="form-control" id="" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <input name="apellido" type="text" class="form-control" id="" placeholder="Apellido">
                    </div>
                    <div class="form-group">
                        <input name="email" type="text" class="form-control" id="" placeholder="Correo">
                    </div>
                    <div class="form-group">
                        <input name="contrasena" type="password" class="form-control" id="" placeholder="Contraseña">
                    </div>  
                    <div class="form-group">
                        <input name="confircontrasena" type="password" class="form-control" id="" placeholder="Confirmar contraseña">
                    </div>  
                    <div class="form-group">
                        <input name="cedula" type="text" class="form-control" id="" placeholder="Cedula">
                    </div>
                    <div class="form-group">
                        <input name="telefono" type="text" class="form-control" id="" placeholder="Telefono">
                    </div>
                    <div class="form-group">
                        <input name="direccion" type="text" class="form-control" id="" placeholder="Direccion">
                    </div>
                    <div class="form-group">
                        <input name="edad" type="text" class="form-control" id="" placeholder="Edad">
                    </div>
                    <div class="form-group">
                        <input name="ciudad" type="text" class="form-control" id="" placeholder="Ciudad">
                    </div>
                    <div class="form-group">
                        <input name="departamento" type="text" class="form-control" id="" placeholder="Departamento">
                    </div>
                    <div class="form-group">
                        <input name="codigo" type="text" class="form-control" id="" placeholder="Codigo">
                    </div>
                    <div class="form-group">
                        <label for="">Escoja su foto de perfil</label>
                        <input name="imagen" type="file" class="form-control" id="" >
                    </div>                 
                    


                    <button type="submit" class="btn btn-warning">Registrar</button>
                    <a href="pagep.php" class="pull-right " style="margin-left:300px;">Iniciar sesion</a>
                </form>

                <?php endif; ?>
                
            </div>
        </div>
        
    </div>
    

<?php require 'inc/footer.inc'; ?>

