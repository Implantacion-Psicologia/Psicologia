<?php

$user="root";
$pass="";
$server="localhost";
$db="emocion_vital";
$con=mysqli_connect($server, $user, $pass, $db) or die ("No se pudo conectar ".mysqli_error());
if($con->connect_error){
    die("Connection failet: " .$con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$codigo = $_POST['codigo'];

    $validar_codigo = "SELECT * FROM login WHERE token LIKE '$codigo'";
    $ejecutar = mysqli_query($con, $validar_codigo);
    if(mysqli_num_rows($ejecutar) > 0){
        $sql = "SELECT id_con FROM login WHERE token = '$codigo'";
        $result = $con->query($sql);
        if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();  
        $_SESSION['user_id'] = $row['id_login'];  
        $user_id = $row['id_login'];
        }
        echo '
        <script>
            alert("Codigo Confirmado");
        </script>
        ';
        header("location: index-pasiente.html");
    }else{
        echo '
        <script>
            alert("El codigo ingresado no coincide con el de la Base de Datos");
            return;
        </script> 
        ';
    }

    mysqli_close($con);
}

?>