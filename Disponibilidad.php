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

$consulta = "SELECT p.n_psi AS Psicologa, h.disponible AS Disponibilidad FROM psicologa p 
            INNER JOIN horario h ON p.id_psi=h.id_psi WHERE p.id_psi=1";
$ejecute = mysqli_query($con, $consulta);
if(mysqli_num_rows($ejecute) > 0){
    while($rom = mysqli_fetch_assoc($ejecute)){
        $n_psi = $rom["Psicologa"];
        $disponible = $rom["Disponibilidad"];
        if($rom["Disponibilidad"] == 1){
            $disponiblecon ='Psicologa: ' . $n_psi . ' -- ' . "Disponibilidad: Activa";
        }else{
            $disponiblecon ='Psicologa: ' . $n_psi . ' -- ' . "Disponibilidad: Inactiva";
        }
    }
}else{
    $disponiblecon = "No se ha encontrada Psicologas/Psicologos";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Disponibilidad</title>
    <link rel="stylesheet" href="Style-frente.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="utf-8">
    <head>
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
          <div id="barraSeleccion">
            <ul>
              <li><a href="index-psi.html">Volver al Menu</a></li>
            </ul>
          </div>
        
          <title>Lista de Consultas</title>
          <style>
              table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
          }
      
          th {
              background-color: #e6f2ff; 
              color: #333;
              border: 1px solid #dddddd;
              text-align: left;
              padding: 8px;
          }
      
          td {
              background-color: #ffffff; 
              color: #333;
              border: 1px solid #dddddd;
              text-align: left;
              padding: 8px;
          }
          </style>
          <link rel="stylesheet" href="Style.css"/>
          <meta charset="utf-8">
      </head>
        <br>
        <br>
        <div class="listaConsulta">
            <br><br>
            <h1>Mi Disponibilidad</h1>
            <br>
        <div>
    </header>
    <body>
        <form class="row g-1 needs-validation" novalidate method="POST" action="psiDisponible.php">
            <p><?php echo $disponiblecon; ?></p>
            <br>
            <h3>¿Desea Modificar su Disponibilidad?</h3>
            <div class="col-md-6">
                <label for="tipo_ced"></label>
                <select name="disponible" id="disponible">
                <option value="1">Activa</option>
                <option value="0">Inactiva</option>
                <div class="valid-feedback">Verificado!</div>
                <div class="invalid-feedback">Seleccione una opcion</div>
            </div>
            <br>
            <div class="enviar">
                <input type ="submit" value = "Cambiar" />
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