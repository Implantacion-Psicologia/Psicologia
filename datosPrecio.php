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

$individual = "";
$infantil = "";
$pareja = "";

$consulta = "SELECT * FROM tipo_consulta";
$ejecute = mysqli_query($con, $consulta);
while ($rom = mysqli_fetch_array($ejecute)){
    if($rom['tipo_consulta'] === "Individual"){
        $individual = "Consulta Individual: " . $rom['precio'] . "$";
    }
    if($rom['tipo_consulta'] === "Infantil"){
        $infantil = "Consulta Infantil: " . $rom['precio'] . "$";
    }
    if($rom['tipo_consulta'] === "Pareja"){
        $pareja = "Consulta Pareja: " . $rom['precio'] . "$";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Cambio de Precio Consultas</title>
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
          
          <link rel="stylesheet" href="Style.css"/>
          <meta charset="utf-8">
<div class="caja">
        </head>
        <div class="listaConsulta">
            <br><br>
            <h1 class="text-center">Precios de las Consultas</h1>
            <br>
        <div>
      </head>
    <body>
        <form class="row g-1 needs-validation" novalidate method="POST" action="cambiarPrecio.php">
            <p><?php echo $individual; ?></p>
            <p><?php echo $infantil; ?></p>
            <p><?php echo $pareja; ?></p>
            <br>
            <h3>Ingrese el Nuevo Precio para una Consulta</h3>
            <div class="col-md-6">
              <label for="tipo_ced">Consulta:</label>
              <select class="form-control rounded" name="idtipocon" id="idtipocon" required>
              <option value="">Seleccione...</option>
              <option value="1">Indivudual</option>
              <option value="2">Infantil</option>
              <option value="3">Pareja</option>
              </select>
              <div class="valid-feedback">¡Todo Correcto!</div>
              <div class="invalid-feedback">Seleccione una opcion</div>
            </div>

            <div class="col-md-6">
              <Label for = ""></Label>
              <input class="form-control rounded" type="text" id= "precio" name ="precio" required pattern = "[0-9]+(\.[0-9]{1,2})?" min="0"
              placeholder = "Nuevo Precio: 00.00"/>
              <div class="valid-feedback">¡Todo Correcto!</div>
              <div class="invalid-feedback">El precio debe ser un número positivo puede tener hasta dos decimales</div>
            </div>

            <br><br>
            <div class="enviar">
              <div>  
                <input class="form-control rounded" type ="submit" value = "Cambiar" />
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