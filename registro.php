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

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$tipo_cedula = $_POST['tipoced'];
$cedula = $_POST['cedula'];
$correo = $_POST['correo'];
$telefono = $_POST['tlf'];
$fecha_nac = $_POST['fechanac'];
$password = $_POST['contraseña'];
$password_repetir = $_POST['verificacont'];
$municipio = $_POST['municipio'];
$estado = $_POST['estado'];

    $verif_cedula = "SELECT * FROM paciente WHERE cedula_pact LIKE '$cedula'";
    $ejecute = mysqli_query($con, $verif_cedula);
    if (mysqli_num_rows($ejecute) > 0){
        echo'
            <script>
                alert("El correo proporcionado ya esta registrado");
                window.history.back();
            </script>
            ';
    }
    $verif_correo = "SELECT * FROM paciente WHERE correo_pact LIKE '$correo'";
    $ejecute = mysqli_query($con, $verif_correo);
    if (mysqli_num_rows($ejecute) > 0){
        echo'
            <script>
                alert("El correo proporcionado ya esta registrado");
                window.history.back();
            </script>
            ';
    }
    $verif_tlf = "SELECT * FROM paciente WHERE tlf_pact LIKE '$telefono'";
    $ejecute = mysqli_query($con, $verif_tlf);
    if (mysqli_num_rows($ejecute) > 0){
        echo'
        <script>
            alert("El telefono proporcionado ya esta registrado");
            window.history.back();
        </script>
        ';
    }

    $password_encrip = md5($password);

$query1 = "INSERT INTO direccion (id_estado, id_municipio) VALUES ('$estado','$municipio')";
    if(mysqli_query($con,$query1) == TRUE){
        $id_direccion = $con->insert_id;
        $query2 = "INSERT INTO login (correo_user, password, tipo_user, token, estatus) VALUES ('$correo','$password_encrip','Paciente', NULL, 'Activo')";
        if(mysqli_query($con,$query2) == TRUE){
            $id_login = $con->insert_id;
            $query3 = "INSERT INTO paciente (id_histcli, n_pact, a_pact, tipo_ced, cedula_pact, correo_pact, id_direccion, id_login, tlf_pact, fecha_nac) VALUES 
                                            (NULL, '$nombres','$apellidos','$tipo_cedula','$cedula','$correo','$id_direccion','$id_login','$telefono','$fecha_nac')";
            if(mysqli_query($con,$query3) == TRUE){
                echo'
                <script>
                    alert("Usuario Registrado con Exito")
                </script> 
                ';
                header("location: index.php");
            }else{
                echo'
                <script>
                    alert("Error en el registro del paciente");
                    window.history.back();
                </script>
                ';
            }
        }else{
            echo'
            <script>
                alert("Error en el registro del usuario");
                window.history.back();
            </script>
            ';
        }
    }else{
        echo'
        <script>
            alert("Error en el registro de la direccion");
            window.history.back();
        </script>
        ';
    }

mysql_close($con);

}

?>