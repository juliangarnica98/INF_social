<?php 
session_start();

if((isset($_SESSION['nombre'])&& isset($_SESSION['idUsuario']) && isset($_SESSION['rol']) && isset($_SESSION['img']))|| isset($_COOKIE['nombre'])){
    
    if(isset($_COOKIE['nombre'])){
        $_SESSION['idUsuario']=$_COOKIE['id'];
        $_SESSION['nombre']=$_COOKIE['nombre'];
        $_SESSION['img']=$_COOKIE['imagen'];
        
        $_SESSION['rol']=$_COOKIE['rol'];
    }
    
    
    header("Location: admin.php");
}


require 'inc/cabecera.inc'; ?>
   
   
    
    <div class="container-fluid">
        <div class="row">
           <div class="col-md-12 text-center">
               <a class="navbar-brand text-warning ml-5 " href="index.php" style="font-size:30px;">Comicaruta</a>
           </div>
        </div>
        
      <div class="row">              
            <div class="col-md-5 col-centrar"> 
               
                <form action="login.php" method="POST" role="form">
                    <legend>Iniciar sesion</legend>

                    <div class="form-group">
                        <input name="email" type="text" class="form-control" id="" placeholder="Correo">
                    </div>
                    <div class="form-group">
                        <input name="contrasena" type="password" class="form-control" id="" placeholder="Contraseña">
                    </div>


                    <button type="submit" class="btn btn-warning">Ingresar</button> &nbsp;&nbsp;
                    <label for="" class="checkbox-inline">
                        <input name="recordar" type="checkbox" value="activo"> Mantener sesíón iniciada
                    </label>
                    <a href="registro.php" class="pull-right" style="margin-left:100px;">Registrarse</a>
                </form>

                
            </div>
        </div>
        
    </div>
    

<?php require 'inc/footer.inc'; ?>













