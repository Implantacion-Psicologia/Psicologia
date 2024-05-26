<?php

// Hola amigos de Youtube :)

session_start();
$user="root";
$pass="";
$server="localhost";
$db="emocion_vital";
$con=mysqli_connect($server, $user, $pass, $db) or die ("No se pudo conectar ".mysqli_error());
if($con->connect_error){
    die("Connection failet: " .$con->connect_error);
}

$usuario = $_POST['correo'];
$contraseña = $_POST['contraseña'];

$validar_login = "SELECT * FROM login WHERE correo_user = '$usuario' AND password = MD5('$contraseña')";
$ejecute = mysqli_query($con, $validar_login);
if(mysqli_num_rows($ejecute) > 0){
    $fila = mysqli_fetch_assoc($ejecute);
    $rol = $fila['tipo_user'];
    if($rol == "Psicologo"){
        $_SESSION['Admin'] = $admin;
        header("location: menuPsiciloga.php");
        exit;
    }else{
        $_SESSION['usuario'] = $usuario;
        header("location: menuPaciente.php");
        exit;
    }
}else{
    echo '
        <script>
            alert("Correo o contraseña incorrectos, favor verificar sus datos");
            window.history.back();
        </script>
        ';
        exit;
    }

?>