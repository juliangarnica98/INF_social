<?php 
require 'lib/errores.php';
require 'lib/config.php';
require 'lib/validarfoto.php';
spl_autoload_register(function($clase){
    require_once "lib/$clase.php";
});

if($_POST['id']){
    extract($_POST, EXTR_OVERWRITE);
    $db = new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);

    $db->preparar("UPDATE usuarios  SET email = ?, contrasena = ?, telefono = ?, direccion = ?, edad = ? WHERE idUsuario =?");
    $db->prep()->bind_param('ssisii', $email, $contrasena ,$telefono, $direccion, $edad, $id);
    
    if(!empty($_FILES['imagen']['name'])){
       if(validarFoto($nombre, true)){
        
            $db->ejecutar();
            $db->liberar();
            header("Refresh:5; url=editar.php");
           $ok="salio bien";
        }else{
           $ok="algo salio mal";
       } 
    }else{
        $db->ejecutar();
        $db->liberar();
        header("Refresh:5; url=editar.php");
        $ok="salio bien";
    }
    
}
?>