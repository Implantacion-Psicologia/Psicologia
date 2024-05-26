<?php

$user="root";
$pass="";
$server="localhost";
$db="emocion_vital";
$con=mysqli_connect($server, $user, $pass, $db) or die ("No se pudo conectar ".mysqli_error());
if($con->connect_error){
    die("Connection failet: " .$con->connect_error);
}

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$tipo_cedula = $_POST['tipoced'];
$cedula = $_POST['cedula'];
$correo = $_POST['correo'];
$telefono = $_POST['tlf'];
$dia = $_POST['dias'];
$mes = $_POST['mes'];
$año = $_POST['años'];
$password = $_POST['contraseña'];
$password_repetir = $_POST['verificacont'];
$municipio = $_POST['municipios'];
$estado = $_POST['estados'];


   /*switch($tipo_cedula){
    case "V":
        if($_POST['cedula'] < 1 || $_POST['cedula'] > 99999999 || !preg_match('/[0-9]{9}$/', $_POST['cedula'])){
            echo'
            <script>
                alert("Error en la estructura de la cedula tipo V");
                window.history.back(); 
            </script> 
            ';
            exit();
        }
    break;
    case "E":
        if($_POST['cedula'] < 1 || $_POST['cedula'] > 999999999 || !preg_match('/[0-9]{10}$/', $_POST['cedula'])){
            echo'
            <script>
                alert("Error en la estructura de la cedula tipo E");
                window.history.back(); 
            </script> 
            ';
            exit();
        }
    break;
    case "J":
        if($_POST['cedula'] < 1 || $_POST['cedula'] > 9999999 || !preg_match('/[0-9]{7}$/', $_POST['cedula'])){
            echo'
            <script>
                alert("Error en la estructura de la cedula tipo J");
                window.history.back(); 
            </script> 
            ';
            exit();
        }
    break;
}
    $verif_cedula = "SELECT * FROM paciente WHERE cedula_pact LIKE '$cedula'";
    $ejecute_cedula = mysqli_query($con, $verif_cedula);
    if (mysqli_num_rows($ejecute_cedula) > 0){
        echo'
            <script>
                alert("El correo proporcionado ya esta registrado");
                window.history.back(); 
            </script> 
            ';
        exit();
        }
    $correo_valido = filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL);
    if($correo_valido && strpos($correo_valido, "@gmail.com") == false || $correo_valido && strpos($correo_valido, "@hotmail.com") == false){
        echo '
        <script>
            alert("Error al guardar el correo electrónico
            No es un Correo electronico valido");
            window.history.back(); 
        </script>
    ';
    exit;
    }
    $verif_correo = "SELECT * FROM paciente WHERE correo_pact LIKE '$correo'";
    $ejecute_correo = mysqli_query($con, $verif_correo);
    if (mysqli_num_rows($ejecute_correo) > 0){
        echo'
            <script>
                alert("El correo proporcionado ya esta registrado");
                window.history.back(); 
            </script> 
            ';
        exit();
    }
    if(!preg_match('/^0[0-9]{3}-[0-9]{7}$/', $_POST['tlf'])){
        echo'
            <script>
                alert("El telefono ingresado no es valido, el formato debe ser parecido al siguiente 0123-4567890");
                window.history.back(); 
            </script> 
            ';
        exit();
    }
    $verif_tlf = "SELECT * FROM paciente WHERE tlf_pact LIKE '$telefono'";
    $ejecute_tlf = mysqli_query($con, $verif_tlf);
    if (mysqli_num_rows($ejecute_tlf) > 0){
        echo'
        <script>
            alert("El telefono proporcionado ya esta registrado");
            window.history.back(); 
        </script> 
        ';
        exit();
    }
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\W]).{8,}$/', $password)) {
        echo ' <script>
                alert("La contraseña debe tener: 
                Al menos 8 caracteres
                Al menos una letra minúscula
                Al menos una letra mayúscula
                Al menos un número
                Al menos un símbolo especial");
                window.history.back(); 
                </script>
                ';
        exit;
    } */
    if($password != $password_repetir){
        echo '<script>
                alert("Las contraseñas no coinciden");
                window.history.back(); 
              </script>
              ';
        exit();
    }
    /*if($dia < 1 || $dia > 31 || $mes < 1 || $mes > 12 || $año < 1960 || $año > 2006){
        echo'
        <script>
            alert("Error en el ingreso de la fecha de nacimiento, Intentelo de nuevo");
            window.history.back(); 
        </script> 
        ';
        exit();
    }*/
    $fecha_nac = $año . "-" . $mes . "-" . $dia;

    $password_encrip = md5($password);

    $query1 = "INSERT INTO direccion (id_estado, id_municipio) VALUES ('$estado','$municipio')";
    if(mysqli_query($con,$query1) == TRUE){
        $id_direccion = $con->insert_id;
        $query2 = "INSERT INTO login (correo_user, password, tipo_user, token, estatus) VALUES ('$correo','$password_encrip','Paciente', NULL, 'Activo')";
        if(mysqli_query($con,$query2) == TRUE){
            $id_login = $con->insert_id;
            $query3 = "INSERT INTO paciente (id_histcli, n_pact, a_pact, tipo_ced, cedula_pact, correo_pact,  id_direccion,id_login, tlf_pact, fecha_nac) VALUES 
                                            (NULL, '$nombres','$apellidos','$tipo_cedula','$cedula','$correo', $id_direccion, $id_login,'$telefono','$fecha_nac')";
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
                    alert("Error en el registro");
                    window.history.back(); 
                </script> 
                ';
                exit();
            }
        }else{
            echo'
            <script>
                alert("Error en el registro");
                window.history.back(); 
            </script> 
            ';
            exit();
        }
    }else{
        echo'
        <script>
            alert("Error en el registro");
            window.history.back(); 
        </script> 
        ';
        exit();
    }
    
mysql_close($con);

?>