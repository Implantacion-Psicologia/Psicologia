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

$tipoced_pact = $_POST['tipoced_pact'];
$cedula_pact = $_POST['cedula_pact'];
$correo_pact = $_POST['correo_pact'];
$nombres_par = $_POST['nombres'];
$apellidos_par = $_POST['apellidos'];
$tipo_cedula_par = $_POST['tipoced'];
$cedula_par = $_POST['cedula'];
$telefono_par = $_POST['tlf'];
$fecha_nac_par = $_POST['fechapareja'];
$municipio = $_POST['municipio'];
$estado = $_POST['estado'];
$id_tipocon = 3;
$psicologa = $_POST['psicologa'];
$fecha_con = $_POST['fechacon'];
$hora_con = $_POST['hora'];
$monto = $_POST['precio'];
$iva = $_POST['iva'];
$duracion = "45 min";

$query_selec = "SELECT id_pact FROM paciente WHERE tipo_ced LIKE '$tipoced_pact' AND cedula_pact LIKE '$cedula_pact' AND correo_pact LIKE '$correo_pact'";
$ejecute = mysqli_query($con,$query_selec);
if (mysqli_num_rows($ejecute) > 0) {
    $fila1 = mysqli_fetch_assoc($ejecute);
    $id_pact = $fila1['id_pact'];
    $query_dir = "INSERT INTO direccion (id_estado, id_municipio) VALUES ('$estado','$municipio')";
    if(mysqli_query($con,$query_dir) == TRUE){
        $id_direccion = $con->insert_id;
        $fecha_nac_par = $año_par . "-" . $mes_par . "-" . $dia_par;
        $query_pareja = "INSERT INTO paciente_pareja (id_pact, n_par, a_par, tipo_ced, cedula_par, tlf_par, id_direccion, fecha_nac) 
            VALUES ('$id_pact','$nombres_par','$apellidos_par','$tipo_cedula_par','$cedula_par','$telefono_par','$id_direccion','$fecha_nac_par')";
        if(mysqli_query($con,$query_pareja) == TRUE){
            $id_pareja = $con->insert_id;
            $query_psi = "SELECT id_psi FROM psicologa WHERE id_psi LIKE '$psicologa'";
            $ejecute = mysqli_query($con,$query_psi);
            if(mysqli_num_rows($ejecute) > 0){
                $fila2 = mysqli_fetch_assoc($ejecute);
                $id_psi = $fila2['id_psi'];
                $query_con = "INSERT INTO consulta (id_pact, id_pactinf, id_pactpar, id_psi, id_tipocon, fecha, hora, duracion, estado_con) 
                    VALUES ('$id_pact', NULL, '$id_pareja','$id_psi','$id_tipocon','$fecha_con','$hora_con','$duracion','Agendada')";
                if(mysqli_query($con,$query_con) == TRUE){
                    $id_con = $con->insert_id;
                    $total = $monto + $iva;
                    $query_factotal = "INSERT INTO precio_total (id_con, precio_tot) VALUES ('$id_con','$total')";
                    if(mysqli_query($con,$query_factotal) == TRUE){
                        echo'
                        <script>
                            alert("Consulta Pareja Agendada")
                        </script> 
                        ';
                        header("location: datosPareja.php");
                    }else{
                    echo'
                    <script>
                        alert("Error en la asignacion del precio");
                        window.history.back();
                    </script>
                    ';
                    }
                }else{
                    echo'
                    <script>
                        alert("Error al agendar la consulta de pareja");
                        window.history.back();
                    </script>
                    ';
                }
            }else{
                echo'
                <script>
                    alert("Error al asignar la Psicologa");
                    window.history.back();
                </script>
                ';
            }
        }else{
            echo'
            <script>
                alert("Error al registrar los datos de la pareja");
                window.history.back();
            </script>
            ';
        }
    }else{
        echo'
        <script>
            alert("Error al ingresar la direccion");
            window.history.back();
        </script>
        ';
    }
}else{
    echo'
    <script>
        alert("Error, no existe paciente con dicha cedula ni dicho correo");
        window.history.back();
    </script>
    ';
}

mysqli_close($con);

}

?>