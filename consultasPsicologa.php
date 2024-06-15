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

$consultapendiente = "SELECT c.id_con AS id_con, ct.tipo_consulta AS tipo_consulta, c.fecha AS fecha, c.hora AS hora, c.estado_con AS estado_con FROM tipo_consulta ct 
                      INNER JOIN consulta c ON ct.id_tipocon=c.id_tipocon 
                      INNER JOIN paciente p ON c.id_pact=p.id_pact 
                      WHERE c.id_psi = 1";
$ejecute = mysqli_query($con, $consultapendiente);
$listaConsultas = "";

if (mysqli_num_rows($ejecute) > 0) {
    while ($lista = mysqli_fetch_array($ejecute)) {
        $listaConsultas .=  '<tr>
                                <td>' . $lista['id_con'] . '</td>
                                <td>' . $lista['tipo_consulta'] . '</td>
                                <td>' . $lista['fecha'] . '</td>
                                <td>' . $lista['hora'] . '</td>
                                <td>' . $lista['estado_con'] . '</td>
                            </tr>';
    }
  }else {
    $listaConsultas = '<tr>
                        <td> No se encuentran Consultas </td>
                      </tr>';
}

?>

<!DOCTYPE html>

<html>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="utf-8">
  </head>
<body>
  <header>
    <br><br>
    <h1>Lista de las Consultas</h1>
  </header>

  <form class="row g-1 needs-validation" novalidate id="listaConsulta" method="POST" action="cambiarEstadoCon.php">

    <h3>Cambiar Estado de Consulta</h3>
    <div class="col-md-6">
      <!-- Identificador de Consulta -->
      <div>
        <label for="">Estatus de la Consulta: </label>
        <select class="form-control rounded" name="estadocon" id="estadocon" required>
        <option value="">Seleccione...</option>
        <option value="Agendada">Agendada</option>
        <option value="Suspendida">Suspendida</option>
        <option value="Realizada">Realizada</option>
        </select>
        <div class="valid-feedback">¡Todo Correcto!</div>
        <div class="invalid-feedback">Ingrese una Opcion</div>
      </div>

      <div>
        <Label for = "cedula"></Label>
        <input class="form-control rounded" type ="text" id= "idcon" name ="idcon" required pattern = "[0-9]+"
        placeholder = "Numero de Consulta"/>
        <div class="valid-feedback">¡Todo Correcto!</div>
        <div class="invalid-feedback">Ingrese solo numeros positivos</div>
      </div>

    </div>

      <br><br>
      <div class="enviar">
        <input type ="submit" value = "Cambiar" />
      </div>

  </form>

    <br><br>
    <table>
      <thead>
        <tr>
          <th>Número de Consulta</th>
          <th>Tipo</th>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Estatus</th>
        </tr>
      </thead>
      <tbody>
        <?php 
            echo $listaConsultas;
        ?>
      </tbody>
    </table>
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