<?php

$user="root";
$pass="";
$server="localhost";
$db="emocion_vital";
$con=mysqli_connect($server, $user, $pass, $db) or die ("No se pudo conectar ".mysqli_error());
if($con->connect_error){
    die("Connection failet: " .$con->connect_error);
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

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Registro </title>
        <link rel="stylesheet" href="Style.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <meta charset="utf-8">
    </head>
    
<!-- Barra de selección -->
<div id="barraSeleccion">
  <ul Class="text-success">
    <li><a href="index.php">Inicio</a></li>
    <li><a href="login.php">Acceder</a></li>
    <li><a href="acerca-de.html">Acerca de</a></li>
    
  </ul>
</div>
 


<div class="text-center">
        <br>
        <br>
        <br>
        <img src="registro-ico.png" width="100"/>
        <h1 class="text-success">Registro </h1>
</div>


  
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
    
    
    
    .caja-texto{
    border:2px solid #dbdbdb;
    background-color: #ffffff;
    padding: 30px;
    margin: 30px;
    width: 300px;
    border-radius: 2%;
    box-sizing: content-box;


    display: block;
    margin-left: auto;
    margin-right: auto;

  }
  
</style>






<body> 
    <div class="caja-texto">
        <form class ="row needs-validation" novalidate id="register" method="post" action="registro.php">
            
            <div>
                <div>
                    <!-- name -->
                    <Label for = "nombre"> </Label>
                    <input class="form-control rounded" type ="text" id= "nombres" name ="nombres" required pattern = "[A-Za-zÀÁÉÍÓÚñü\s-]+"
                    placeholder = "Nombres"/>
                    <div class="valid-feedback">¡Todo Correcto!</div>
                    <div class="invalid-feedback">Ingrese solo Letras</div>
                </div>
                   
                <div>
                    <!-- surname -->
                    <Label for = "apellido"> </Label>
                    <input class="form-control rounded" type ="text" id= "apellidos" name ="apellidos" required pattern = "[A-Za-zÀÁÉÍÓÚñü\s-]+"
                    placeholder = "Apellidos"/>
                    <div class="valid-feedback">¡Todo Correcto!</div>
                    <div class="invalid-feedback">Ingrese solo Letras</div>
                </div>
            </div>

            <br>

            
            <!-- cedula -->
            <div>
                <div>
                    <label  for="tipo_ced"></label>
                    <select class="form-control rounded" name="tipoced" id="languages"required>
                    <option value="">Tipo Cedula...</option>
                    <option value="V">V</option>
                    <option value="E">E</option>
                    <option value="J">J</option>
                    </select>
                    <div class="valid-feedback">¡Todo Correcto!</div>
                    <div class="invalid-feedback">Seleccione una Opcion</div>
                </div>

                <div>
                    <Label  for = "cedula"></Label>
                    <input class="form-control rounded" type ="text" id= "cedula" name ="cedula" required pattern = "[0-9]{8}"
                    placeholder = "Cedula"/>
                    <div class="valid-feedback">¡Todo Correcto!</div>
                    <div class="invalid-feedback">La cédula debe tener 8 dígitos numéricos</div>
                <div>
            </div>
            
            <br>

            <!-- Tlf -->
            <div>
                <Label for = "Telefono"></Label>
                <input class="form-control rounded" type ="text" id= "tlf" name ="tlf" required pattern = "^(04|02)[0-9]{9}$"
                placeholder = "Telefono" />
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">El teléfono debe tener el formato 04XXXXXXXXX o 02XXXXXXXXX</div>
            </div>
            
            <p>
            <br>
            <br>    
            Direccion
            </p>
            <div>
                <label for="estado">Estados: </label>
                <select class="form-control rounded" id="estado" name="estado" id="languages" required onchange="showMunicipios()">
                <option value="">Seleccionar Estado</option>
                <?php echo loadEstadosOptions($con); ?>
                </select>
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Seleccione una opcion</div>
            </div>

            <br>

            <div>
                <label for="municipio">Municipios: </label>
                <select class="form-control rounded" id="municipio" name="municipio" id="languages" required disabled>
                <option>Seleccione un estado primero</option>
                </select>
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Seleccione una Opcion</div>
            </div>

            <br>

            <div>
                <label> Fecha de Nacimiento: </label> 
                <Label for=""></label>
                <input class="form-control rounded" type="date" name="fechanac" required max="<?php echo date('Y-m-d',strtotime('-1 day')); ?>"/> 
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Seleccione una Fecha Valida</div>
            </div>

            <br>

            <!-- E.mail -->
            <div>
                <Label for = "Correo"></Label>
                <input class="form-control rounded" type ="text" id= "correo" name ="correo" required pattern = "^.+@(?:gmail|hotmail)\.(com)$"
                placeholder = "Correo" />
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">El correo debe tener el formato usuario@gmail.com o usuario@hotmail.com</div>
            </div>
            

            <!-- password -->
            <div>
            <div>
                <label for = "contraseña"></label>
                <input class="form-control rounded" id = "contraseña" name = "contraseña" type = "password" required pattern = "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$"
                placeholder="Contraseña"/>
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">La contraseña debe tener al menos 8 caracteres, incluir una letra minúscula, una mayúscula y un número</div>
            </div>

            <!-- password verification-->
            <div>
                <label for = "verifica contraseña"> </label>
                <input class="form-control rounded" id = "verificacont" name = "verificacont" type = "password" required 
            placeholder ="Verifica contraseña"/>
            </div>
            
            <br>

            <div class="enviar">
              <div>  
                <input class="form-control rounded" type ="submit" value = " Registrarse " />
              </div>
            </div>
        
        </form>
    <div>

</body>

<div class="text-center">
    <p class="text-center">¿Ya estas resgistrado? <a href="login.php" >Inicia sesion</a></p>
    <p class="text-center">Volver al <a href="index.php" >inicio</a></p>
    <p class="text-center">Copyrigt 2024</p>
</div>



</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
crossorigin="anonymous"></script>

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

<script>/*
    const form = document.getElementById('register'); 

    form.addEventListener('submit', function(event) {
    event.preventDefault();

    const password = document.getElementById('contraseña').value;
    const confirmPassword = document.getElementById('verificacont').value;

    if (password !== confirmPassword) {
        alert("Las contraseñas no coinciden. Por favor, vuelve a ingresarlas.");
        return;
    }else{
        form.submit();
    }
})
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
