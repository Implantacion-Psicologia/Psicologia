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

$correo = $_POST['correo'];

function genera_token(){
    return bin2hex(random_bytes(8));
}

    $validar_correo = "SELECT * FROM login WHERE correo_user LIKE '$correo'";
    $ejecutar = mysqli_query($con, $validar_correo);
    if(mysqli_num_rows($ejecutar) > 0){
        $token = genera_token();
        $query = "UPDATE login SET token = '$token' WHERE correo_user LIKE '$correo'";
        if(mysqli_query($con,$query) == TRUE){
            $asunto = "Solicitud de Recuperacion de Usuario";
            $mensaje = "Hola $correo \n\nHas solicitado recuperar tu usuario para ello utiliza el siguiente token\n\n$token\n\nPulsa el siguiente enlace para recuperar el usuario
                \n\nlink xD";
            mail($correo, $asunto, $mensaje);
            echo '
                <script>
                    alert("Se ha enviado un correo electrónico con instrucciones para recuperar tu contraseña"); 
                </script>
            ';
            header("location: IngCodRec.html");
        }else{
            echo '
                <script>
                    alert("Error en el envio del token");
                    return;
        </script> 
        ';
        }
    }else{
        echo '
        <script>
            alert("El correo proporcionado no esta registrado");
            return;
        </script> 
        ';
    }

mysql_close($con);

}

?>