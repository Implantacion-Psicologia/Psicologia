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

    $disponibilidad = $_POST['disponible'];
    
    $estatus = "";
    if($disponibilidad == 1){
        $estatus = "Activo";
    }else{
        $estatus = "Inactivo";
    }
    
    $update = "UPDATE horario h JOIN psicologa p ON h.id_psi=p.id_psi SET h.disponible='$disponibilidad', p.estatus='$estatus' WHERE p.id_psi=1";
    if(mysqli_query($con,$update) == TRUE){
        echo '<script>
                alert("Modificacion exitosa");
            <script>';
        header("location: Disponibilidad.php");
    }else{
        echo '<script>
                alert("Fallo al cambiar la disponibilidad");
                return;
            <script>';
    }

    mysqli_close($con);
}

?>