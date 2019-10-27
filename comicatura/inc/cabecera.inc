<?php 
    $archivoactual =$_SERVER['SCRIPT_NAME'];
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comicatura</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    
</head >
<body class="<?php if( $archivoactual == '/comicatura/pagep.php' || $archivoactual == '/comicatura/registro.php' ) {echo 'bg';} ?>">
        

<header>
   <?php if( $archivoactual != '/comicatura/pagep.php' and $archivoactual != '/comicatura/registro.php' and $archivoactual != '/comicatura/login.php' and $archivoactual != '/comicatura/logout.php'): ?>
    

    
   <a href="admin.php" class="logo">
      <i class="fas fa-book"></i>
       <span>Comicatura</span>
   </a>

    

      
   

<nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
      
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
    </button>

      <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
<!--
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
-->
         <?php if($_SESSION['rol']==profesor): ?>
          <li class="nav-item  "><a class=" mas" href="editar.php"><i class="fas fa-edit"></i></a></li>     
           <li class="nav-item  "><a class=" mas" href="admin.php"><i class="fas fa-street-view " ></i></a></li>
           <li class="nav-item  "><a class=" mas" href="#"><i class="fas fa-eye " ></i></a></li>
           
          
          <?php else: ?>
                
           <li class="nav-item  "><a class=" mas" href="student.php"><i class="fas fa-eye"></i></a></li>
           <li class="nav-item  "><a class=" mas" href="activity.php"><i class="fas fa-book-open"></i></a></li>
        <?php endif; ?>
          
         </ul>
         <ul class="navbar-nav ml-auto">
          <li class="nav-item ">
            <a class="nav-link " href="logout.php" tabindex="-1" aria-disabled="true">Cerrar sesion <i class="fas fa-sign-out-alt"></i></a>
          </li>
        </ul>
   
      </div>
</nav>
<?php endif; ?>
    
    
</header>
