<?php

session_start();

$user="root";
$pass="";
$server="localhost";
$db="emocion_vital";
$con=mysqli_connect($server, $user, $pass, $db) or die ("No se pudo conectar ".mysqli_error());
if($con->connect_error){
    die("Connection failet: " .$con->connect_error);
}

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    echo 'No se encontro nada';
}
$menu = "";
if($user_id == 1){
    $menu =  '<div id="barraSeleccion">
                <ul>
                <li><a href="index-psi.html">Volver al Menu</a></li>
                </ul>
            </div>';
}else{
    $menu = '<div id="barraSeleccion">
                <ul>
                <li><a href="index-pasiente.html">Volver al Menu</a></li>
                </ul>
            </div>';
}

$psicologa_selec="";
$consultapsi = "SELECT psicologa.id_psi, psicologa.n_psi FROM psicologa WHERE psicologa.estatus='Activo'";
$ejecut = mysqli_query($con, $consultapsi);
if(mysqli_num_rows($ejecut) > 0){
    while($rom = mysqli_fetch_assoc($ejecut)){
        $id_psi = $rom["id_psi"];
        $n_psi = $rom["n_psi"];
        $psicologa_selec .= "<option value='$id_psi'>$n_psi</option>";
    }
}else{
    $psicologa_selec = "<option value=''>No hay Psicologas Disponibles</option>";
}

$preciocon = "";
$consultapre = "SELECT precio FROM tipo_consulta WHERE tipo_consulta = 'Infantil'";
$ejecute = mysqli_query($con, $consultapre);
if(mysqli_num_rows($ejecute) > 0){
    while($rom = mysqli_fetch_assoc($ejecute)){
        $precio = $rom["precio"];
        $iva = $precio * 0.16;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Agendar Consulta Infantil</title>
    <link rel="stylesheet" href="Style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="utf-8">
</head>

<body>
<style>
      /* Estilos para la barra de selección */
      #barraSeleccion {
        position: fixed; /* Fija la barra en la pantalla */
        top: 0; /* Alinea la barra en la parte superior */
        left: 0; /* Alinea la barra a la izquierda */
        width: 100%; /* Ancho completo */
        background-color: #64b468; /* Color de fondo */
        color: white; /* Color del texto */
        z-index: 1000; /* Asegura que la barra esté sobre otros elementos */
      }
    
      /* Estilos para los elementos dentro de la barra */
      #barraSeleccion ul {
        list-style-type: none; /* Remueve los estilos de lista */
        margin: 0;
        padding: 0;
        overflow: hidden;
      }
    
      #barraSeleccion li {
        float: left; /* Alinea los elementos horizontalmente */
      }
    
      #barraSeleccion li a {
        display: block; /* Hace que los enlaces llenen el espacio del 'li' */
        text-align: center; /* Centra el texto */
        padding: 14px 16px; /* Espaciado interno */
        text-decoration: none; /* Remueve el subrayado del enlace */
      }
    
      /* Cambia el color de fondo al pasar el mouse */
      #barraSeleccion li a:hover {
        background-color: #9eb952;
      }

      .caja{
        border:2px solid #dbdbdb;
        background-color: #ffffff;
        padding: 50px;
        margin: 50px;
        width: 400px;
        border-radius: 2%;
        box-sizing: content-box;


        display: block;
        margin-left: auto;
        margin-right: auto;

        
        }
    </style>
    
      <!-- Barra de selección -->
      <?php echo $menu; ?>
    
    <div class="caja">
        <header class="text-center"> 
            <img src="Logo-Psicologia.jpeg" width="100"/>
            <h2>Agenda de Consultas Infante</h2>
        </header>
        <br>

        <form class="needs-validation" novalidate id= "agendaInfante" method="POST" action="agendarInfante.php">
            <h3>
                Ingrese sus Datos
            </h3>
                
            <br>
        
            <!-- cedula -->
            <div class="row">
                <div>
                    <label for="tipoced"></label>
                    <select class="col-md-4 form-control rounded" name="tipoced" id="tipoced" required>
                    <option value="">Tipo Cedula...</option>
                    <option value="V">V</option>
                    <option value="E">E</option>
                    <option value="J">J</option>
                    </select>
                    <div class="valid-feedback">¡Todo Correcto!</div>
                    <div class="invalid-feedback">Seleccione una Opcion</div>
                </div>
                <div>
                    <Label for = "cedula"></Label>
                    <input class="col-md-4 form-control rounded" type ="text" id= "cedula" name ="cedula" required pattern = "[0-9]+"
                    placeholder = "Cedula"/>
                    <div class="valid-feedback">¡Todo Correcto!</div>
                    <div class="invalid-feedback">Ingrese solo numeros</div>
                </div>
            </div>

        
            <!-- correo -->
            <div>
                <Label for = "Correo"></Label>
                <input class="col-md-4 form-control rounded" type ="text" id= "correo" name ="correo" required pattern = "^.+@(?:gmail|hotmail)\.(com)$"
            placeholder = "Correo" />
            <div class="valid-feedback">¡Todo Correcto!</div>
            <div class="invalid-feedback">El correo debe tener el formato usuario@gmail.com o usuario@hotmail.com</div>
            </div>
        
         
            <div>
                <Label for="tipoced"></label>
                <input class="col-md-4 form-control rounded" type ="text" id="numerohijo" name ="numerohijo" required pattern = "[0-9]{1}" min="1" max=9
            placeholder = "Numero de Hijo"/>
            <div class="valid-feedback">¡Todo Correcto!</div>
            <div class="invalid-feedback">Ingrese solo numeros no menores a 1 ni mayores a 9</div>
            </div>
            <br>

            <h3>
                Datos del Infante
            </h3>
            <!-- name -->
            <div>
                <Label for = "nombres"> </Label>
                <input class="col-md-4 form-control rounded" type ="text" id= "nombres" name ="nombres" required pattern = "[A-Za-zÀÁÉÍÓÚñü\s-]+"
                placeholder = "Nombres"/>
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            
            
            <!-- surname -->
            <div>
                <Label for = "apellidos"> </Label>
                <input class="col-md-4 form-control rounded" type ="text" id= "apellidos" name ="apellidos" required pattern = "[A-Za-zÀÁÉÍÓÚñü\s-]+"
                placeholder = "Apellidos"/>
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            

            <!-- fecha-->
            <label> Fecha de Nacimiento del Niño: </label> 
            <div class="form-floating mb-3">
                <Label for=""></label>
                <div>
                    <input class="col-md-4 form-control rounded" type="date" name="fechainf" required max="<?php echo date('Y-m-d',strtotime('-1 day')); ?>"/> 
                    <div class="valid-feedback">¡Todo Correcto!</div>
                    <div class="invalid-feedback">Seleccione una Fecha Valida</div>
                </div>
            </div>

           
            <br>

            <h3>
                Datos de la Consulta
            </h3>
            <label for="psicologa">Psicologa: </label>
            <div>
                <select class="col-md-4 form-control rounded" id="psicologa" name="psicologa" required>
                <?php echo $psicologa_selec; ?>
                </select>    
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Seleccione una Opcion</div>
            </div>

            <br>

            <!-- Male selection-->
            <label> Fecha de Consulta: </label> 
            <div class="form-floating mb-3">
                <Label for=""></label>
                <div>
                    <input class="col-md-4 form-control rounded" type="date" name="fechacon" required min="<?php echo date('Y-m-d'); ?>"/> 
                    <div class="valid-feedback">¡Todo Correcto!</div>
                    <div class="invalid-feedback">Seleccione una Fecha valida</div>
                </div>
            </div>

            

            <!-- monto -->
            <div>
            <label> Hora de Consulta: </label> 
                <select class="col-md-4 form-control rounded" name="hora" id="hora" required>
                <option value="">Seleccione...</option>
                <option value="08:00:00">08:00 AM</option>
                <option value="10:00:00">10:00 AM</option>
                <option value="12:00:00">12:00:PM</option>
                <option value="14:00:00">02:00 PM</option>
                <option value="16:00:00">04:00 PM</option>
                <option value="18:00:00">06:00 PM</option>
                </select>
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Seleccione una Opcion</div>
            </div>

            <br>
            <label>Precio de la Consulta</label> 
            <div class="row">
                <div>
                    <Label for="cedula"></label>
                    <input class="col-md-4 form-control rounded" type="text" name="precio" value="<?php echo $precio ?>" disabled/>
                    <br>
                    <label>IVA</label> 
                    <Label for="cedula"></label>
                    <input class="col-md-4 form-control rounded" type="text" name="iva" value="<?php echo $iva ?>" disabled/>
                </div>
            </div>
            <br>
            <p>Duracion de Consultas: 45 min</p>
        
            <div class="enviar">   
                <div class="col-md-12">    
                    <input class="form-control rounded" type ="submit" value = "Agendar Consulta" />
                </div>
            </div>

        </form>
        </body>
    </div>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    (function () {
  'use strict'

  var forms = document.querySelectorAll('.needs-validation')

  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()    
</script>