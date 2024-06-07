<?php

$user="root";
$pass="";
$server="localhost";
$db="emocion_vital";
$con=mysqli_connect($server, $user, $pass, $db) or die ("No se pudo conectar ".mysqli_error());
if($con->connect_error){
    die("Connection failet: " .$con->connect_error);
}

function loadMunicipiosOptions($con) {
    $sql = "SELECT municipios.id_municipio, municipios.municipio, estados.estado 
            FROM municipios 
            INNER JOIN estados ON municipios.id_estado = estados.id_estado";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $municipio_id = $row["id_municipio"];
            $municipio = $row["municipio"];
            $estado = $row["estado"];
            $municipio_options .= "<option value='$municipio_id'>$municipio ($estado)</option>";
        }
    } else {
        $municipio_options = "<option value=''>No hay Municipios disponibles</option>";
    }

    return $municipio_options;
}

$estado_selec= "";
$consulta = "SELECT id_estado, estado FROM estados";
$ejecut = mysqli_query($con, $consulta);
if(mysqli_num_rows($ejecut) > 0){ 
    while($rom = mysqli_fetch_assoc($ejecut)){
        $id_estado = $rom["id_estado"];
        $nom_estado = $rom["estado"];
        $estado_selec .= "<option value='$id_estado'>$nom_estado</option>"; 
    }
}else{
    $estado_selec = "<option value=''>No se han encontrado Estados</option>";
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
    
<body>
    <header> 
        <br>
        <br>
        <img src="registro-ico.png" width="100"/>
        <h1>Registro </h1>
    </header>
    


    
    <form class="row g-2 needs-validation" novalidate id="register" method="post" action="registro.php">
        
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
        
        <br>

        <!-- Tlf -->
        <div class="col-md-6">
            <Label for = "Telefono"></Label>
            <input type ="text" id= "tlf" name ="tlf" required pattern = "^04[12]{2}-\d{4}-\d{6}$"
            placeholder = "Telefono" />
            <div class="valid-feedback">Verificado!</div>
            <div class="invalid-feedback">El teléfono debe tener el formato 04XX-XXXXXXX</div>
        </div>
        
        <p>
            Direccion
        </p>
        <div class = "col-md-6">
            <label for="estado">Estados: </label>
            <select id="estado" name="estado" id="languages" required onchange="showMunicipios()">
            <option value="">Seleccionar Estado</option>
            <?php echo $estado_selec; ?>
            </select>
            <div class="valid-feedback">Verificado!</div>
            <div class="invalid-feedback">Seleccione una opcion</div>
        </div>

        <br>
        
        <div class = "col-md-6">
            <label for="municipio">Municipios: </label>
            <select id="municipio" name="municipio" id="languages" require disabled>
            <option value="">Seleccionar Municipio</option>
            <?php echo loadMunicipiosOptions($con) ?>
            </select>
            <div class="valid-feedback">Verificado!</div>
            <div class="invalid-feedback">Seleccione una opcion</div>
        </div>

        <br>
        <div class="form-floating mb-3">
            <label> Fecha de Nacimiento: </label> 
            <Label for=""></label>
            <input type="date" name="fechanac" required max="<?php echo date('Y-m-d',strtotime('-1 day')); ?>"/> 
            <div class="valid-feedback">Verificado!</div>
            <div class="invalid-feedback">Seleccione una Fecha Valida</div>
        </div>
        <br>

        <!-- E.mail -->
        <div class="col-md-6">
            <Label for = "Correo"></Label>
            <input type ="text" id= "correo" name ="correo" required pattern = "^.+@(?:gmail|hotmail)\.(com)$"
            placeholder = "Correo" />
            <div class="valid-feedback">Verificado!</div>
            <div class="invalid-feedback">El correo debe tener el formato usuario@gmail.com o usuario@hotmail.com</div>
        </div>

        <br>

        <!-- password -->
        <div class = "col-md-6">
            <label for = "contraseña"></label>
            <input id = "contraseña" name = "contraseña" type = "password" requiered pattern = "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\W]).{8,}$"
            placeholder="Contraseña"/>
            <div class="valid-feedback">Verificado</div>
            <div class="invalid-feedback">La contraseña debe tener al menos 8 caracteres, incluir al menos una letra minúscula, una mayúscula, un número y un símbolo especial</div>
        </div>
        
        <br>
        <div class = "col-md-6">
        <!-- password verification-->
            <label for = "verifica contraseña"> </label>
            <input id = "verificacont" name = "verificacont" type = "password" required 
            placeholder ="Verifica contraseña"/>
        </div>

        <br>

        <div class="enviar">
            <input type ="submit" value = "Registrarse" />
        </div>
    
    </form>

</body>
<footer>
    
    <p>¿Ya estas resgistrado? <a href="login.html" >Inicia sesion</a></p>
    <p>Volver al <a href="index.html" >inicio</a></p>
    <p>Copyrigt 2024</p>
</footer>



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
    const form = document.getElementById('register'); 

    form.addEventListener('submit', function(event) {
    event.preventDefault();

    const password = document.getElementById('contraseña').value;
    const confirmPassword = document.getElementById('verificacont').value;

    if (password !== confirmPassword) {
        alert("Las contraseñas no coinciden. Por favor, vuelve a ingresarlas.");
        return;
    }
})
</script>

<script>
    function showMunicipios() {
        var estadoSelect = document.getElementById("estado");
        var municipioSelect = document.getElementById("municipio");
        municipioSelect.disabled = estadoSelect.value === "";
    }
</script>
