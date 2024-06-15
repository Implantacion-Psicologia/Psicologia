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

$query = "SELECT p.id_pact AS id_pact, l.id_login AS id_login FROM paciente p 
            INNER JOIN login l ON p.id_login = l.id_login WHERE p.id_login = $user_id";
$ejecutar = mysqli_query($con, $query);
if(mysqli_num_rows($ejecutar) > 0){
    $fila = mysqli_fetch_assoc($ejecutar);
    $id_pact = $fila['id_pact'];
}

$consultapendiente = "SELECT ct.tipo_consulta AS tipo_consulta, c.fecha AS fecha, c.hora AS hora, c.estado_con AS estado_con FROM tipo_consulta ct 
                        INNER JOIN consulta c ON ct.id_tipocon=c.id_tipocon 
                        INNER JOIN paciente p ON c.id_pact=p.id_pact WHERE p.id_pact = '$id_pact'";
$ejecute = mysqli_query($con, $consultapendiente);
$ContAgendadas = 1;
$ContCanceladas = 1;
$ContRealizadas = 1;
$consultasAgendadas = "";
$consultasCanceladas = "";
$consultasRealizadas = "";

while ($lista = mysqli_fetch_array($ejecute)) {
    if ($lista['estado_con'] == 'Agendada') {
        $consultasAgendadas .= '<tr>
                                  <td>' . $ContAgendadas++ . '</td>
                                  <td>' . $lista['tipo_consulta'] . '</td>
                                  <td>' . $lista['fecha'] . '</td>
                                  <td>' . $lista['hora'] . '</td>
                                  <td>' . $lista['estado_con'] . '</td>
                                </tr>';
    }
    if ($lista['estado_con'] == 'Suspendida') {
        $consultasCanceladas .= '<tr>
                                  <td>' . $ContCanceladas++ . '</td>
                                  <td>' . $lista['tipo_consulta'] . '</td>
                                  <td>' . $lista['fecha'] . '</td>
                                  <td>' . $lista['hora'] . '</td>
                                  <td>' . $lista['estado_con'] . '</td>
                                </tr>';
    }
    if ($lista['estado_con'] == 'Realizada') {
        $consultasRealizadas .= '<tr>
                                  <td>' . $ContRealizadas++ . '</td>
                                  <td>' . $lista['tipo_consulta'] . '</td>
                                  <td>' . $lista['fecha'] . '</td>
                                  <td>' . $lista['hora'] . '</td>
                                  <td>' . $lista['estado_con'] . '</td>
                                </tr>';
    }
}

if (empty($consultasAgendadas)) {
    $consultasAgendadas = '<tr>
                            <td> No posee Consultas en Espera </td>
                          <tr>';
}
if (empty($consultasCanceladas)) {
    $consultasCanceladas =  '<tr>
                              <td> No posee Consultas Canceladas </td>
                            <tr>';
}
if (empty($consultasRealizadas)) {
    $consultasRealizadas =  '<tr>
                              <td> No posee Consultas Realizadas </td>
                            <tr>';
}

?>

<!DOCTYPE html>

<html>
<head>
    <title>Consultas Agendadas Usuario</title>

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
          <li><a href="index-pasiente.html">Volver al Menu</a></li>
        </ul>
      </div>

    <style>
        table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    th {
        background-color: #e6f2ff; /* Light green */
        color: #333;
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    td {
        background-color: #ffffff; /* White */
        color: #333;
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    </style>
    <link rel="stylesheet" href="Style.css"/>
    <meta charset="utf-8">
</head>

<body>
  <header>
    <br><br>
    <h1>Lista de Consultas del Usuario</h1>
  </header>

  <form id="listaConsulta" method="POST">
      <h2>Consultas Agendadas</h2>
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
            echo $consultasAgendadas;
        ?>
      </tbody>
    </table>

    <br><br>

    <h2>Consultas Suspendidas</h2>
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
                echo $consultasCanceladas;
            ?>
          </tbody>
        </table>

    <br><br>

    <h2>Consultas Realizadas</h2>
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
            echo $consultasRealizadas;
        ?>
      </tbody>
    </table>
  </form>
</body>
</html>