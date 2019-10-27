<?php                  

function miGestorErrores( $errno, $errstr, $errfile, $errline ) {
    
    if( !(error_reporting() & $errno ) ) {
        return;
    }
    
    switch( $errno ) {
        case E_USER_ERROR:
            echo "
                <div class='alerta alerta_error'>
                   <div class='alerta_icon'>
                       <i class='glyphicon glyphicon-exclamation-sign'></i>
                   </div>
                   <div class='alerta_wrapper'> Error:  $errstr
                   </div><a href='#' class='close err'><i class='glyphicon glyphicon-remove'></i></a>
               </div>
                ";
            break;
            exit(1);
            
        case E_USER_WARNING:
            echo "
                <div class='alerta alerta_warning'>
                   <div class='alerta_icon'>
                       <i class='glyphicon glyphicon-warning-sign'></i>
                   </div>
                   <div class='alerta_wrapper'> Error: [$errno] $errstr, este problema se presentó en la línea $errline, en el archivo $errfile <a href='#'>Ayuda</a>
                   </div><a href='#' class='close err'><i class='glyphicon glyphicon-remove'></i></a>
               </div>
                ";
            exit;
            break;
            
        case E_USER_NOTICE:
            echo "
                <div class='alerta alerta_info'>
                   <div class='alerta_icon'>
                       <i class='glyphicon glyphicon-info-sign'></i>
                   </div>
                   <div class='alerta_wrapper'> $errstr
                   </div><a href='#' class='close err'><i class='glyphicon glyphicon-remove'></i></a>
               </div>
                ";
            break;
        /*default:
            echo "Error desconocido: [$errno] $errstr<br>";*/
    }
    
    
    
}
set_error_handler( 'miGestorErrores' );
