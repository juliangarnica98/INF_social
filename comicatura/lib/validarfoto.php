<?php

function validarFoto($nombre, $update=false){
    
    if($update){
        borrarCarpeta("fotos/$nombre");
    }
        
        
    global $dirSubida;
    global $rutaSubida;
    global $error;
    
    $dirSubida ="fotos/$nombre.$apellido/";
    $imagen=$_FILES['imagen'];
    $nombrefoto=$imagen['name'];
    $nombretem=$imagen['tmp_name'];
    $rutaSubida="{$dirSubida}profile.jpg";
    $extArchivo=preg_replace('/image\//','',$imagen['type']);

    if($extArchivo== 'jpeg' || $extArchivo== 'png' ){
        if(!file_exists($dirSubida)){
            mkdir($dirSubida,0777);
        }
        if( move_uploaded_file($nombretem ,$rutaSubida)){
            //echo "<img class='img-responsive ' src='$rutaSubida'>";
            return true;
        }else{
            trigger_error('No se pudo mover el archivo',E_USER_ERROR);
            
        }
    }else{
         trigger_error('No es un formato de imagen valido',E_USER_ERROR);
        
        //trigger_error('No es un formato de imagen valido', E_USER_WARNING);
        
    }
    return $error;
    //var_dump($imagen);
    
    
}
function borrarCarpeta($dir){
        $gestor=opendir($dir);
        while (false != ($archivo = readdir($gestor))){
            if($archivo != '.' && $archivo != '..'  ){
                if(!unlink("$dir/$archivo") ){
                   //borrarCarpeta("$dir/$archivo");
                }
                
            }
        }
        closedir($gestor);
        rmdir($dir);
        sleep(1);
}

