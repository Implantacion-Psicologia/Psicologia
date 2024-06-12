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

function loadMunicipiosOptions($con, $selected_estado = null) {
    $sql = "SELECT municipios.id_municipio, municipios.municipio, estados.estado 
            FROM municipios 
            INNER JOIN estados ON municipios.id_estado = estados.id_estado";
    
    if ($selected_estado) {
        $sql .= " WHERE municipios.id_estado = ?";
    }
    
    $stmt = $con->prepare($sql);
    if ($selected_estado) {
        $stmt->bind_param("i", $selected_estado);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $municipio_options = "<option value=''>Seleccione...</option>";
        while ($row = $result->fetch_assoc()) {
            $municipio_id = $row["id_municipio"];
            $municipio = $row["municipio"];
            $estado = $row["estado"];
            $municipio_options .= "<option value='$municipio_id'>$municipio</option>";
        }
    } else {
        $municipio_options = "<option value=''>No hay Municipios disponibles</option>";
    }

    return $municipio_options;
}

function loadEstadosOptions($con) {
    $sql = "SELECT id_estado, estado FROM estados";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $estado_options = "<option value=''>Seleccione...</option>";
        while ($row = $result->fetch_assoc()) {
            $estado_id = $row["id_estado"];
            $estado_nombre = $row["estado"];
            $estado_options .= "<option value='$estado_id'>$estado_nombre</option>";
        }
    } else {
        $estado_options = "<option value=''>No hay estados disponibles</option>";
    }

    return $estado_options;
}

// Procesar la solicitud AJAX para cargar municipios
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_estado'])) {
    echo loadMunicipiosOptions($con, $_POST['id_estado']);
    exit;
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
    $psicologa_selec = "<option value=''>No hay Psicologas Disponibles";
}

$preciocon = "";
$consultapre = "SELECT precio FROM tipo_consulta WHERE tipo_consulta = 'Pareja'";
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
    <title>Agendar Consulta Pareja</title>
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
    </style>
    
      <!-- Barra de selección -->
      <?php echo $menu; ?>
    <header> 
        <br>
        <br>
        <img src="Logo-Psicologia.jpeg" width="100"/>
        <h2>Agenda de Consultas de Pareja</h2>
    
    </header>
    
    
    </header>

    <form class="row g-2 needs-validation" novalidate id= "agendaPareja" method="POST" action="agendarPareja.php">
       
        <h3>
            Ingrese sus Datos
        </h3>

        <br>

         <!-- cedula -->
         <div class="row">
            <div class="col-md-6">
                <label for="tipoced"></label>
                <select name="tipoced_pact" id="tipoced_pact">
                <option value="V">V</option>
                <option value="E">E</option>
                <option value="J">J</option>
                </select>
                <div class="valid-feedback">Verificado!</div>
                <div class="invalid-feedback">Seleccione un Tipo</div>
                

                <div>
                <Label for = "cedula"></Label>
                <input type ="number" id= "cedula_pact" name ="cedula_pact" required pattern = "[0-9]+"
                placeholder = "Cedula"/>
                <div class="valid-feedback">Verificado!</div>
                <div class="invalid-feedback">Ingrese solo numeros</div>

                </div>
                
            </div>
        </div>

    
        <!-- correo -->
        <div class="col-md-6">
            <Label for = "Correo"></Label>
            <input type ="text" id= "correo" name ="correo_pact" required pattern = "^.+@(?:gmail|hotmail)\.(com)$"
            placeholder = "Correo" />
            <div class="valid-feedback">Verificado!</div>
            <div class="invalid-feedback">El correo debe tener el formato usuario@gmail.com o usuario@hotmail.com</div>
        </div>
    
        <br>

        <h3>
            Datos de la Pareja
        </h3>
        <div class="row">
            <div class="col-md-6">
                <!-- name -->
                <Label for = "nombre"> </Label>
                <input type ="text" id= "nombres" name ="nombres" required pattern="[A-Za-z]"
                placeholder = "Nombres"/>
                <div class="valid-feedback">Verificado!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
                
                <br>
                
                <!-- surname -->
                <Label for = "apellido"> </Label>
                <input type ="text" id= "apellidos" name ="apellidos" required pattern="[A-Za-z]"
                placeholder = "Apellidos"/>
                <div class="valid-feedback">Verificado!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
        </div>
    
        <br>

    
        <!-- cedula -->
        <div class="row">
            <div class="col-md-6">
                <label for="tipo_ced"></label>
                <select name="tipo_ced" id="languages">
                <option value="V">V</option>
                <option value="E">E</option>
                <option value="J">J</option>
                </select>
                <div class="valid-feedback">Verificado!</div>
                <div class="invalid-feedback">Seleccione un Tipo</div>
        
                <Label for = "cedula"></Label>
                <input type ="text" id= "cedula" name ="cedula" required pattern = "[0-9]{8}"
                placeholder = "Cedula"/>
                <div class="valid-feedback">Verificado!</div>
                <div class="invalid-feedback">La cédula debe tener 8 dígitos numéricos</div>
            </div>
        </div>
       
       
        <!-- Tlf -->
        <div class="col-md-6">
            <Label for = "Telefono"></Label>
            <input type ="text" id= "tlf" name ="tlf" required pattern = "^04[12]{2}-\d{4}-\d{6}$"
            placeholder = "Telefono" />
            <div class="valid-feedback">Verificado!</div>
            <div class="invalid-feedback">El teléfono debe tener el formato 04XX-XXXXXXX</div>
        </div>

        <br>

        <!-- fechas-->
        <div class="form-floating mb-3">
            <label> Fecha de Consulta:</label> 
            <Label for=""></label>
            <input type="date" name="fechapareja" required max="<?php echo date('Y-m-d',strtotime('-1 day')); ?>"/>  
            <div class="valid-feedback">Verificado!</div>
            <div class="invalid-feedback">Seleccione una Fecha valida</div>
        </div>

        <br>
        <p>Direccion de la Pareja</p>
        <div class = "col-md-6">
            <label for="estado">Estados: </label>
            <select id="estado" name="estado" id="languages" required onchange="showMunicipios()">
            <option value="">Seleccionar Estado</option>
            <?php echo loadEstadosOptions($con); ?>
            </select>
            <div class="valid-feedback">Verificado!</div>
            <div class="invalid-feedback">Seleccione una opcion</div>
        </div>

        <br>
        
        <div class="col-md-6">
            <label for="municipio">Municipios: </label>
            <select id="municipio" name="municipio" required disabled>
            <option value=''>Seleccione un estado primero</option>
            </select>
            <div class="valid-feedback">Verificado!</div>
            <div class="invalid-feedback">Seleccione una opcion</div>
        </div>
        
        <br>
        <br>

        <h3>
            Datos de la Consulta
        </h3>
        <div class="col-md-6">
            <label for="psicologa">Psicologa: </label>
            <select id="psicologa" name="psicologa" required>
                <option value="">Disponibles</option>
                <?php echo $psicologa_selec; ?>
            </select>    
            <div class="valid-feedback">Verificado!</div>
            <div class="invalid-feedback">Seleccione una Opcion</div>
        </div>

        <br><br>

        <!-- Male selection-->
        <div class="form-floating mb-3">
            <label> Fecha de Consulta:</label> 
            <Label for=""></label>
            <input type="date" name="fechacon" required min="<?php echo date('Y-m-d'); ?>"/> 
            <div class="valid-feedback">Verificado!</div>
            <div class="invalid-feedback">Seleccione una Fecha valida</div>
        </div>

        <br><br>

        <!-- monto -->
        <div class="col-md-6">
            <label> Hora de Consulta:</label> 
            <select name="hora" id="hora">
                <option value="">Seleccionar</option>
                <option value="08:00:00">08:00 AM</option>
                <option value="10:00:00">10:00 AM</option>
                <option value="12:00:00">12:00 PM</option>
                <option value="14:00:00">02:00 PM</option>
                <option value="16:00:00">04:00 PM</option>
                <option value="18:00:00">06:00 PM</option>
            </select>
            <div class="valid-feedback">Verificado!</div>
            <div class="invalid-feedback">Seleccione una Opcion</div>
        </div>

        <br>
        <label>Precio de la Consulta</label> 
        <div class="row">
            <div class="col-md-6">
                <Label for="cedula"></Label>
                <input type="text" name="precio" value="<?php echo $precio ?>" disabled/>
                <br>
                <label>IVA</label> 
                <Label for="cedula"></Label>
                <input type="text" name="iva" value="<?php echo $iva ?>" disabled/>
            </div>
        </div>
        <p>Duracion de Consultas: 45 min</p>
       
        <div class="enviar">
            <input type="submit" value="Agendar Consulta" />
        </div>

    </form>
</body>
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

<script>
   function showMunicipios() {
                var estadoSelect = document.getElementById('estado');
                var municipioSelect = document.getElementById('municipio');
                var estado_id = estadoSelect.value;
    
                if (estado_id === '') {
                    municipioSelect.innerHTML = "<option value=''>Seleccione un estado primero</option>";
                    municipioSelect.disabled = true;
                    return;
                }
    
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        municipioSelect.innerHTML = xhr.responseText;
                        municipioSelect.disabled = false;
                    }
                };
                xhr.send('id_estado=' + estado_id);
            }
</script>
