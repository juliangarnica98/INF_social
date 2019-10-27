<?php 
session_start();

 $caduca = time()-95365;
    if(isset($_COOKIE['nombre'])){
        setcookie('id', $_SESSION['idUsuario'], $caduca);
        setcookie('nombre', $_SESSION['nombre'], $caduca);
        setcookie('img', $_SESSION['imagen'], $caduca);
    }
session_unset();

session_destroy();

header("Location: index.php");

?>


<?php require 'inc/cabecera.inc'; ?>

  <div class="container-fluid">
        <div class="row">
          
           <div class="col-md-6 caja text-center col-centrar" style="padding-top:100px;">
              
               
           </div>

        </div>

        
    </div>
    

<?php require 'inc/footer.inc'; ?>