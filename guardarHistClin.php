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

    // Datos I
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $fecha_nac = $_POST['fechanac'];
    $direccion =  $_POST['direccion'];
    $telefono =  $_POST['telefono'];
    $escolaridad = $_POST['escolaridad'];
    $escuela =  $_POST['escuela'];
    $promedio =  $_POST['promedio'];
    $lugar_familia =  $_POST['lugarfamilia'];

    $query = "SELECT cedula_pact FROM paciente WHERE cedula_pact LIKE '$cedula'";
    $ejecutar = mysqli_query($con, $query);
    if(mysqli_num_rows($ejecutar) > 0){
        $fila = mysqli_fetch_assoc($ejecutar);
        $id_pact = $fila['id_pact'];
    }else{
        echo'
        <script>
            alert("Error en la cedula... No coincide con ningun paciente");
            return;
        </script> 
        ';
    }

    $queryI = "INSERT INTO escuela_lugarfamiliar_d1 (D1_d1, D1_d2, D1_d3, D1_d4, D1_d5, D1_d6, D1_d7, D1_d8, D1_d9) 
    VALUES ('$nombre','$cedula','$fecha_nac','$direccion','$telefono','$escolaridad','$escuela','$promedio','$lugar_familia')";
    if(mysqli_query($con,$queryI) == TRUE){
        $id_D1 = $con->insert_id;
    }else{
        echo'
        <script>
            alert("Error en el ingreso de los Datos: Parte I");
            return;
        </script> 
        ';
    }

    //Datos II
    $motivo_con = $_POST['motivocon'];
    $referido = $_POST['referido'];
    $diagnostico_organico = $_POST['diagorganico'];
    $actitud_padres = $_POST['actitudpadres'];
    $estado_emocional = $_POST['estadoemocionalniño'];

    $queryII = "INSERT INTO fact_motivacion_d2 (D2_d1, D2_d2, D2_d3, D2_d4, D2_d5) 
    VALUES ('$motivo_con','$referido','$diagnostico_organico','$actitud_padres','$estado_emocional')";
    if(mysqli_query($con,$queryII) == TRUE){
        $id_D2 = $con->insert_id;
    }else{
        echo'
        <script>
            alert("Error en el ingreso de los Datos: Parte II");
            return;
        </script> 
        ';
    }

    //Datos III
    $desarrollo_prenatal = $_POST['desarrolloprental'];
    $desarrollo_infancia = $_POST['desarolloinfancia'];

    $queryIII = "INSERT INTO fact_fisicos_d3 (D3_d1, D3_d2) 
    VALUES ('$desarrollo_prenatal','$desarrollo_infancia')";
    if(mysqli_query($con,$queryIII) == TRUE){
        $id_D3 = $con->insert_id;
    }else{
        echo'
        <script>
            alert("Error en el ingreso de los Datos: Parte III");
            return;
        </script> 
        ';
    }

    //Datos IV
    $padre_nombre = $_POST['nombrepadre'];
    $padre_salud = $_POST['saludpadre'];
    $padre_educativo = $_POST['educativopadre'];
    $padre_trabajo = $_POST['trabajopadre'];
    $padre_horario = $_POST['horariopadre'];
    $padre_habitos = $_POST['habitospadre'];
    $madre_nombre = $_POST['nombrem'];
    $madre_salud = $_POST['saludmadre'];
    $madre_educativo = $_POST['educativomadre'];
    $madre_trabajo = $_POST['trabajomadre'];
    $madre_horario = $_POST['horariomadre'];
    $madre_habitos = $_POST['habitosmadre'];

    $perdida_familiar = $_POST['perdidafamilia'];
    $perdida_quien = $_POST['perdidaquien'];
    $como_fue = $_POST['comofue'];
    $edad_perdida = $_POST['edadniño1'];
    $presencio_suceso = $_POST['presenciasuceso'];
    $reaccion_niño = $_POST['reaccionsuceso'];
    $accidentes_niño = $_POST['accidenteniño'];
    $castigos_graves = $_POST['castigoniño'];
    $castigo_quien = $_POST['castigoquien'];
    $edad_castigo = $_POST['edadniño2'];
    $problemas_causas = $_POST['problemasniño'];
    $problemas_fisicos = $_POST['problemafisico'];

    $queryIV = "INSERT INTO fact_familiares_d4 (D4_d1, D4_d2, D4_d3, D4_d4, D4_d5, D4_d6, D4_d7, D4_d8, D4_d9, D4_d10, D4_d11, D4_d12, D4_d13, D4_d14, D4_d15, D4_d16, D4_d17, D4_d18, D4_d19, D4_d20, D4_d21, D4_d22, D4_d23, D4_d24) 
    VALUES ('$padre_nombre','$madre_nombre','$padre_salud','$madre_salud','$padre_educativo','$madre_educativo','$padre_trabajo','$madre_trabajo','$padre_horario','$madre_horario','$padre_habitos','$madre_habitos','$perdida_familiar','$perdida_quien','$como_fue','$edad_perdida','$presencio_suceso','$reaccion_niño','$accidentes_niño','$castigos_graves','$castigo_quien','$edad_castigo','$problemas_causas','$problemas_fisicos')";
    if(mysqli_query($con,$queryIV) == TRUE){
        $id_D4 = $con->insert_id;
    }else{
        echo'
        <script>
            alert("Error en el ingreso de los Datos: Parte IV");
            return;
        </script> 
        ';
    }

    //Datos V
    $comida = $_POST['comida'];
    $sueño = $_POST['sueno'];
    $eliminaciones = $_POST['eliminaciones'];
    $manias_tics = $_POST['maniastics'];
    $historia_sexual = $_POST['sexual'];
    $rasgos_peculiares = $_POST['peculiares'];

    $timido = isset($_POST['timido']) ? 1 : 0;
    $agresivo = (isset($_POST['agresivo'])) ? 1 : 0;
    $tranquilo = (isset($_POST['tranquilo'])) ? 1 : 0;
    $irritable = (isset($_POST['irritable'])) ? 1 : 0;
    $alegre = (isset($_POST['alegre'])) ? 1 : 0;
    $triste = (isset($_POST['triste'])) ? 1 : 0;
    $cooperativo = (isset($_POST['cooperativo'])) ? 1 : 0;
    $negativista = (isset($_POST['negativista'])) ? 1 : 0;
    $sereno = (isset($_POST['sereno'])) ? 1 : 0;
    $impulsivo = (isset($_POST['impulsivo'])) ? 1 : 0;
    $confiado = (isset($_POST['confiado'])) ? 1 : 0;
    $frio = (isset($_POST['frio'])) ? 1 : 0;
    $sociable = (isset($_POST['sociable'])) ? 1 : 0;
    $retardado = (isset($_POST['retardado'])) ? 1 : 0;
    $equilibrado = (isset($_POST['equilibrado'])) ? 1 : 0;
    $nervioso = (isset($_POST['nervioso'])) ? 1 : 0;
    $cariñoso = (isset($_POST['cariñoso'])) ? 1 : 0;
    $inseguro = (isset($_POST['inseguro'])) ? 1 : 0;
    $juega = (isset($_POST['juega'])) ? 1 : 0;
    $no_juega = (isset($_POST['nojuega'])) ? 1 : 0;
    $controlado = (isset($_POST['controlado'])) ? 1 : 0;
    $emotivo = (isset($_POST['emotivo'])) ? 1 : 0;
    $seguro = (isset($_POST['seguro'])) ? 1 : 0;
    $amable = (isset($_POST['amable'])) ? 1 : 0;
    $desconsiderado = (isset($_POST['desconsiderado'])) ? 1 : 0;
    $laborioso = (isset($_POST['laborioso'])) ? 1 : 0;
    $perezoso = (isset($_POST['perezoso'])) ? 1 : 0;
    $desconfiado = (isset($_POST['desconfiado'])) ? 1 : 0;
    $dominante = (isset($_POST['dominante'])) ? 1 : 0;
    $sumiso = (isset($_POST['sumiso'])) ? 1 : 0;
    $disciplinado = (isset($_POST['disciplinado'])) ? 1 : 0;
    $indisiplinado = (isset($_POST['indisiplinado'])) ? 1 : 0;
    $rebelde = (isset($_POST['rebelde'])) ? 1 : 0;
    $obediente = (isset($_POST['obediente'])) ? 1 : 0;
    $ordenado = (isset($_POST['ordenado'])) ? 1 : 0;
    $desordenado = (isset($_POST['desordenado'])) ? 1 : 0;

    $queryV = "INSERT INTO fact_persoz_y_conduc_d5 (D5_d1, D5_d2, D5_d3, D5_d4, D5_d5, D5_d6, D5_d7, D5_d8, D5_d9, D5_d10, D5_d11, D5_d12, D5_d13, D5_d14, D5_d15, D5_d16, D5_d17, D5_d18, D5_d19, D5_d20, D5_d21, D5_d22, D5_d23, D5_d24, D5_d25, D5_d26, D5_d27, D5_d28, D5_d29, D5_d30, D5_d31, D5_d32, D5_d33, D5_d34, D5_d35, D5_d36, D5_d37, D5_d38, D5_d39, D5_d40, D5_d41, D5_d42) 
    VALUES ('$comida','$sueño','$eliminaciones','$manias_tics','$historia_sexual','$rasgos_peculiares','$timido','$agresivo','$tranquilo','$irritable','$alegre','$triste','$cooperativo','$negativista','$sereno','$impulsivo','$confiado','$frio','$sociable','$retardado','$equilibrado','$nervioso','$carinoso','$inseguro','$juega','$no_juega','$controlado','$emotivo','$seguro','$amable','$desconsiderado','$laborioso','$perezoso','$desconfiado','$dominante','$sumiso','$disciplinado','$indisiplinado','$rebelde','$obediente','$ordenado','$desordenado')";
    if(mysqli_query($con,$queryV) == TRUE){
        $id_D5 = $con->insert_id;
    }else{
        echo'
        <script>
            alert("Error en el ingreso de los Datos: Parte V");
            return;
        </script> 
        ';
    }

    //Datos VI
    $incidencia_anomalias = $_POST['incidencia'];
    $tratamiento_nerviosismo = $_POST['tratamientonervios'];
    $alcoholismo = $_POST['alcohol'];
    $abuso_drogas = $_POST['drogas'];
    $debilidad_mental = $_POST['debilmental'];
    $convulsiones_desmayos = $_POST['convulsion'];
    $ets = $_POST['enfermedadsexo'];
    $suicidio = $_POST['suicidio'];
    $anormalidades = $_POST['anormalidad'];
    $trastornos_habla = $_POST['transtorno'];
    $trasornos_vista = $_POST['trasorno'];

    $queryVI = "INSERT INTO fact_hereditarios_d6 (D6_d1, D6_d2, D6_d3, D6_d4, D6_d5, D6_d6, D6_d7, D6_d8, D6_d9, D6_d10, D6_d11) 
    VALUES ('$incidencia_anomalias','$tratamiento_nerviosismo','$alcoholismo','$abuso_drogas','$debilidad_mental','$convulsiones_desmayos','$ets','$suicidio','$anormalidades','$trastornos_habla','$trasornos_vista')";
    if(mysqli_query($con,$queryVI) == TRUE){
        $id_D6 = $con->insert_id;
    }else{
        echo'
        <script>
            alert("Error en el ingreso de los Datos: Parte VI");
            return;
        </script> 
        ';
    }

    //Datos VII
    $impresion_psicologica = $_POST['impresion'];

    $queryVII = "INSERT INTO impresion_psi_d7 (D7_d1) 
    VALUES ('$impresion_psicologica')";
    if(mysqli_query($con,$queryVII) == TRUE){
        $id_D7 = $con->insert_id;
    }else{
        echo'
        <script>
            alert("Error en el ingreso de los Datos: Parte VII");
            return;
        </script> 
        ';
    }

    //Datos VIII
    $recomendaciones = $_POST['recomendacion'];

    $queryVIII = "INSERT INTO recomendaciones_d8 (D8_d1) 
    VALUES ('$recomendaciones')";
    if(mysqli_query($con,$queryVIII) == TRUE){
        $id_D8 = $con->insert_id;
    }else{
        echo'
        <script>
            alert("Error en el ingreso de los Datos: Parte VIII");
            return;
        </script> 
        ';
    }

    //Datos IX
    $plan_psicoterapeutico = $_POST['plan_psicoterapeutico'];

    $queryIX = "INSERT INTO plan_psicoterapeutico_d9 (D9_d1) 
    VALUES ('$plan_psicoterapeutico')";
    if(mysqli_query($con,$queryIX) == TRUE){
        $id_D9 = $con->insert_id;
    }else{
        echo'
        <script>
            alert("Error en el ingreso de los Datos: Parte IX");
            return;
        </script> 
        ';
    }

    //Historial Clinico

    $query_historialClinico = "INSERT INTO historial_clinico (id_D1, id_D2, id_D3, id_D4, id_D5, id_D6, id_D7, id_D8, id_D9) 
    VALUES ('$id_D1','$id_D2','$id_D3','$id_D4','$id_D5','$id_D6','$id_D7','$id_D8','$id_D9')";
    if(mysqli_query($con,$query_historialClinico) == TRUE){
        $id_histcli = $con->insert_id;
        $query_update = "UPDATE paciente SET paciente.id_histcli = '$id_histcli' WHERE paciente.id_pact = '$id_pact'";
        if(mysqli_query($con,$query_update) == TRUE){
            echo '
            <script>
                alert("Historial Medico Creado y Guardado");
                return;
            </script> ';
            header("location: datosHistorialClinico.html");
        }
    }else{
        echo'
        <script>
            alert("Error Fatal... En el Historial Clinico");
            return;
        </script> 
        ';
    }

    
    mysqli_close($con);
}


?>