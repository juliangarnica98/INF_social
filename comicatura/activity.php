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
  <div class="row justify-content-center">
            <div class="col-sm-8">
            <div class="caja ">
                              <img class=" float-right img-responsive " src="img/comic1.jpg" alt="">
                              </div>
                </div>
        </div>


                
   <div class="row justify-content-center">
            <div class="col-sm-10">
<!--                              <img class=" float-right img-responsive " src="img/comic1.jpg" alt="">-->

                <div class="caja ">
    <form action="grade.php" method="post" id="quiz">
    <ul>

    <h3>CSS Stands for.</h3>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-A" value="A" />
        <label for="question-1-answers-A">A) Computer Styled Sections </label>
    </div>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-B" value="B" />
        <label for="question-1-answers-B">B) Cascading Style Sheets</label>
    </div>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-C" value="C" />
        <label for="question-1-answers-C">C) Crazy Solid Shapes</label>
    </div>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-D" value="D" />
        <label for="question-1-answers-D">D) None of the above</label>
    </div>

    </ul>
    
    <ul>
    <h3>CSS Stands for.</h3>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-A" value="A" />
        <label for="question-1-answers-A">A) Computer Styled Sections </label>
    </div>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-B" value="B" />
        <label for="question-1-answers-B">B) Cascading Style Sheets</label>
    </div>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-C" value="C" />
        <label for="question-1-answers-C">C) Crazy Solid Shapes</label>
    </div>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-D" value="D" />
        <label for="question-1-answers-D">D) None of the above</label>
    </div>

    </ul>
     <ul>
    <h3>CSS Stands for.</h3>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-A" value="A" />
        <label for="question-1-answers-A">A) Computer Styled Sections </label>
    </div>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-B" value="B" />
        <label for="question-1-answers-B">B) Cascading Style Sheets</label>
    </div>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-C" value="C" />
        <label for="question-1-answers-C">C) Crazy Solid Shapes</label>
    </div>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-D" value="D" />
        <label for="question-1-answers-D">D) None of the above</label>
    </div>

    </ul>
     <ul>
    <h3>CSS Stands for.</h3>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-A" value="A" />
        <label for="question-1-answers-A">A) Computer Styled Sections </label>
    </div>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-B" value="B" />
        <label for="question-1-answers-B">B) Cascading Style Sheets</label>
    </div>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-C" value="C" />
        <label for="question-1-answers-C">C) Crazy Solid Shapes</label>
    </div>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-D" value="D" />
        <label for="question-1-answers-D">D) None of the above</label>
    </div>

    </ul>
     <ul>
    <h3>CSS Stands for.</h3>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-A" value="A" />
        <label for="question-1-answers-A">A) Computer Styled Sections </label>
    </div>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-B" value="B" />
        <label for="question-1-answers-B">B) Cascading Style Sheets</label>
    </div>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-C" value="C" />
        <label for="question-1-answers-C">C) Crazy Solid Shapes</label>
    </div>
    
    <div>
        <input type="radio" name="question-1-answers" id="question-1-answers-D" value="D" />
        <label for="question-1-answers-D">D) None of the above</label>
    </div>

    </ul>
    <div class="text-center">
        <input class="btn btn-success"  type="submit" value="Evaluar" />
    </div>
  
   
    </form>
<!--
   <div class="row">
            <div class="col-sm-12">
                <div class="caja">
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
                    </table>
                </div>
       </div>
</div>
-->
            </div>
        </div>
    </div>
</div>


<?php require 'inc/footer.inc'; ?>