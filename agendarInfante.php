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

$cedula = $_POST['cedula'];
$tipoced = $_POST['tipoced'];
$correo = $_POST['correo'];
$cedula_inf = $_POST['numerohijo'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$fecha_inf = $_POST['fechaint'];
$id_tipocon = 2;
$psicologa = $_POST['psicologa'];
$fecha_con = $_POST['fechacon'];
$hora_con = $_POST['hora'];
$monto = $_POST['precio'];
$iva = $_POST['iva'];
$duracion = "45 min";

$query_selec = "SELECT id_pact FROM paciente WHERE tipo_ced LIKE '$tipoced' AND cedula_pact LIKE '$cedula' AND correo_pact LIKE '$correo'";
$ejecute = mysqli_query($con,$query_selec);
if (mysqli_num_rows($ejecute) > 0) {
    $fila1 = mysqli_fetch_assoc($ejecute);
    $id_pact = $fila1['id_pact'];
    $query_psi = "SELECT id_psi FROM psicologa WHERE id_psi LIKE '$psicologa'";
    $ejecute = mysqli_query($con,$query_psi);
    if(mysqli_num_rows($ejecute) > 0){
        $fila2 = mysqli_fetch_assoc($ejecute);
        $id_psi = $fila2['id_psi'];
        $cedela_inf = $cedula . "-" . $cedula_inf;
        $query_infante = "INSERT INTO paciente_infantil (id_pact, nomb_infa, apel_infa, cedula_inf, fecha_naci_infa) 
            VALUES ('$id_pact','$nombres','$apellidos','$cedela_inf','$fecha_inf')";
        if(mysqli_query($con,$query_infante) == TRUE){
            $id_infante = $con->insert_id;
            $query_con = "INSERT INTO consulta (id_pact, id_pactinf, id_pactpar, id_psi, id_tipocon, fecha, hora, duracion, estado_con) 
            VALUES ('$id_pact', '$id_infante', NULL,'$id_psi','$id_tipocon','$fecha_con', '$hora_con', '$duracion','Agendada')";
            if(mysqli_query($con,$query_con) == TRUE){
                $id_con = $con->insert_id;
                $total = $monto + $iva;
                $query_factotal = "INSERT INTO precio_total (id_con, precio_tot) VALUES ('$id_con','$total')";
                if(mysqli_query($con,$query_factotal) == TRUE){
                    echo'
                    <script>
                        alert("Consulta Infante Agendada")
                    </script> 
                    ';
                    header("location: datosInfante.php");
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
                    alert("Error en la consulta infante");
                    window.history.back();
                </script>
                ';
                }
        }else{
            echo'
            <script>
                alert("Error en el registro del infante");
                window.history.back();
            </script>
            ';
        }
    }else{
        echo'
        <script>
            alert("Error en la asignacion de la Psicologa");
            window.history.back();
        </script>
        ';
    }
}else{
    echo'
    <script>
        alert("Error, Los datos proporcionados: Cedula y/o Correo
        No coinciden con su Cuenta, ingrese los datos correctamente");
        window.history.back();
    </script>
    ';
}

mysqli_close($con);

}

?>