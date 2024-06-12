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

    $id_con = $_POST['idcon'];
    $estado_con = $_POST['estadocon'];

    $consulta = "SELECT id_con FROM consulta WHERE id_con = '$id_con'";
    $ejecute = mysqli_query($con, $consulta);
    if(mysqli_num_rows($ejecute) > 0){
        $update = "UPDATE consulta SET estado_con = '$estado_con' WHERE id_con = '$id_con'";
        if(mysqli_query($con, $update) == TRUE){
            echo '<script>
                    alert("Modificacion exitosa");
                <script>';
            header("location: consultasPsicologa.php");
        }else{
            echo '<script>
                    alert("Fallo al cambiar el estado de la Consulta");
                    return;
                <script>';
        }
    }else{
        echo '<script>
                alert("Error, el Identificador de la consulta no existe");
                return;
            <script>';
    }
    
    mysqli_close($con);
}


?>