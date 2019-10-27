<?php session_start();?>

<?php require 'inc/cabecera.inc'; ?>
<div class="container-fluid">
        <div class="row">            
            <div class="col-md-6 col-centrar"> 
<?php
    if( $_POST){
        require 'lib/errores.php';
        require 'lib/config.php';
        spl_autoload_register(function($clase){
            require_once "lib/$clase.php";
        });
    //convirtiendo array en variables
        extract( $_POST, EXTR_OVERWRITE);
        $nombre = strtolower($nombre);
        
        if(empty($email) || empty($contrasena)){
            trigger_error("No pueden haber campos vacios, sera direccionado a la pagina principal en 5 segundos",E_USER_ERROR);
                header("Refresh:4 url=pagep.php");
        }
        
        if($email && $contrasena){
            $db = new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            
            $validaremail = $db->validarDatos('email','usuarios',$email);
            $expreg='/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/ ';

            if(preg_match($expreg,$email)){
                if($validaremail!=0){  
                    $db->preparar("SELECT idUsuario,CONCAT(nombre,' ',apellido) AS nombrecompleto,contrasena,email,imagen,rol FROM usuarios WHERE email='$email'");
                    $db->ejecutar();
                    $db->prep()->bind_result($dbid,$dbnombrecompleto,$dbcontrasena,$dbemail, $dbrutaimg,$dbrol);
                    $db->resultado();
                    
            
                    if($dbemail == $email){
                        if($contrasena == $dbcontrasena){
                            $_SESSION['idUsuario']=$dbid;
                            $_SESSION['nombre']=$dbnombrecompleto;
                            $_SESSION['imagen']=$dbrutaimg;
                            $_SESSION['rol']=$dbrol;
                            
                            $caduca = time()+365*24*60*60;
                            if($_POST['recordar'] == 'activo'){
                                setcookie('id', $_SESSION['idUsuario'], $caduca);
                                setcookie('nombre', $_SESSION['nombre'], $caduca);
                                setcookie('img', $_SESSION['imagen'], $caduca);
                                setcookie('rol', $_SESSION['rol'], $caduca);
                            }
                            switch($dbrol){
                                case 'profesor':
                                    header("Location: admin.php");
                                    break;
                                case 'estudiante':
                                    header("Location: student.php");
                                    break;
                                          
                            }
                            
                        }else{
                            trigger_error("La contaseña no coincide con el correo, sera direccionado a la pagina principal en 5 segundos",E_USER_ERROR);
                            header("Refresh:4 url=index.php");
                        }
                    }
                }else{
                    trigger_error("El email no existe, sera direccionado a la pagina principal en 5 segundos",E_USER_ERROR);
                    header("Refresh:4 url=index.php");
                }                          
            }else{
                trigger_error("Debe ingresar un correo valido, sera direccionado a la pagina principal en 5 segundos",E_USER_ERROR);
                header("Refresh:4 url=index.php");
            }
       } 
}
?>    
                 </div>
         </div>
 </div>
<?php require 'inc/footer.inc'; ?>
               
