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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_tipocon = $_POST['idtipocon'];
    $precio = $_POST['precio'];

    $update = "UPDATE tipo_consulta SET precio = '$precio' WHERE id_tipocon = '$id_tipocon'";
    if(mysqli_query($con,$update) == TRUE){
        echo '<script>
                alert("Modificacion exitosa");
            <script>';
        header("location: datosPrecio.php");
    }else{
        echo '<script>
                alert("Fallo al cambiar el precio de la Consulta");
                return;
            <script>';
    }

    mysqli_close($con);
}


?>