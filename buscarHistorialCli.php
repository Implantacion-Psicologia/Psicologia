<?php

$user = "root";
$pass = "";
$server = "localhost";
$db = "emocion_vital";
$con = mysqli_connect($server, $user, $pass, $db) or die ("No se pudo conectar: " . mysqli_error($con));

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $cedula = $_GET['cedula'];

    $traerpaciente = "SELECT id_pact FROM paciente WHERE cedula_pact = '$cedula'";
    $ejec = mysqli_query($con, $traerpaciente);
    if (mysqli_num_rows($ejec) > 0) {
        $fila = mysqli_fetch_assoc($ejec);
        $id_pact = $fila['id_pact'];
    } else {
        $id_pact = 0;
    }

    $consulta = "
    SELECT historial_clinico.*,
    escuela_lugarfamiliar_d1.D1_d1,
    escuela_lugarfamiliar_d1.D1_d2,
    escuela_lugarfamiliar_d1.D1_d3,
    escuela_lugarfamiliar_d1.D1_d4,
    escuela_lugarfamiliar_d1.D1_d5,
    escuela_lugarfamiliar_d1.D1_d6,
    escuela_lugarfamiliar_d1.D1_d7,
    escuela_lugarfamiliar_d1.D1_d8,
    escuela_lugarfamiliar_d1.D1_d9,
    fact_motivacion_d2.D2_d1,
    fact_motivacion_d2.D2_d2,
    fact_motivacion_d2.D2_d3,
    fact_motivacion_d2.D2_d4,
    fact_motivacion_d2.D2_d5,
    fact_fisicos_d3.D3_d1,
    fact_fisicos_d3.D3_d2,
    fact_familiares_d4.D4_d1,
    fact_familiares_d4.D4_d2,
    fact_familiares_d4.D4_d3,
    fact_familiares_d4.D4_d4,
    fact_familiares_d4.D4_d5,
    fact_familiares_d4.D4_d6,
    fact_familiares_d4.D4_d7,
    fact_familiares_d4.D4_d8,
    fact_familiares_d4.D4_d9,
    fact_familiares_d4.D4_d10,
    fact_familiares_d4.D4_d11,
    fact_familiares_d4.D4_d12,
    fact_familiares_d4.D4_d13,
    fact_familiares_d4.D4_d14,
    fact_familiares_d4.D4_d15,
    fact_familiares_d4.D4_d16,
    fact_familiares_d4.D4_d17,
    fact_familiares_d4.D4_d18,
    fact_familiares_d4.D4_d19,
    fact_familiares_d4.D4_d20,
    fact_familiares_d4.D4_d21,
    fact_familiares_d4.D4_d22,
    fact_familiares_d4.D4_d23,
    fact_familiares_d4.D4_d24,
    fact_persoz_y_conduc_d5.D5_d1,
    fact_persoz_y_conduc_d5.D5_d2,
    fact_persoz_y_conduc_d5.D5_d3,
    fact_persoz_y_conduc_d5.D5_d4,
    fact_persoz_y_conduc_d5.D5_d5,
    fact_persoz_y_conduc_d5.D5_d6,
    fact_persoz_y_conduc_d5.D5_d7,
    fact_persoz_y_conduc_d5.D5_d8,
    fact_persoz_y_conduc_d5.D5_d9,
    fact_persoz_y_conduc_d5.D5_d10,
    fact_persoz_y_conduc_d5.D5_d11,
    fact_persoz_y_conduc_d5.D5_d12,
    fact_persoz_y_conduc_d5.D5_d13,
    fact_persoz_y_conduc_d5.D5_d14,
    fact_persoz_y_conduc_d5.D5_d15,
    fact_persoz_y_conduc_d5.D5_d16,
    fact_persoz_y_conduc_d5.D5_d17,
    fact_persoz_y_conduc_d5.D5_d18,
    fact_persoz_y_conduc_d5.D5_d19,
    fact_persoz_y_conduc_d5.D5_d20,
    fact_persoz_y_conduc_d5.D5_d21,
    fact_persoz_y_conduc_d5.D5_d22,
    fact_persoz_y_conduc_d5.D5_d23,
    fact_persoz_y_conduc_d5.D5_d24,
    fact_persoz_y_conduc_d5.D5_d25,
    fact_persoz_y_conduc_d5.D5_d26,
    fact_persoz_y_conduc_d5.D5_d27,
    fact_persoz_y_conduc_d5.D5_d28,
    fact_persoz_y_conduc_d5.D5_d29,
    fact_persoz_y_conduc_d5.D5_d30,
    fact_persoz_y_conduc_d5.D5_d31,
    fact_persoz_y_conduc_d5.D5_d32,
    fact_persoz_y_conduc_d5.D5_d33,
    fact_persoz_y_conduc_d5.D5_d34,
    fact_persoz_y_conduc_d5.D5_d35,
    fact_persoz_y_conduc_d5.D5_d36,
    fact_persoz_y_conduc_d5.D5_d37,
    fact_persoz_y_conduc_d5.D5_d38,
    fact_persoz_y_conduc_d5.D5_d39,
    fact_persoz_y_conduc_d5.D5_d40,
    fact_persoz_y_conduc_d5.D5_d41,
    fact_persoz_y_conduc_d5.D5_d42,
    fact_hereditarios_d6.D6_d1,
    fact_hereditarios_d6.D6_d2,
    fact_hereditarios_d6.D6_d3,
    fact_hereditarios_d6.D6_d4,
    fact_hereditarios_d6.D6_d5,
    fact_hereditarios_d6.D6_d6,
    fact_hereditarios_d6.D6_d7,
    fact_hereditarios_d6.D6_d8,
    fact_hereditarios_d6.D6_d9,
    fact_hereditarios_d6.D6_d10,
    fact_hereditarios_d6.D6_d11,
    impresion_psi_d7.D7_d1,
    recomendaciones_d8.D8_d1,
    plan_psicoterapeutico_d9.D9_d1
    FROM 
     historial_clinico 
    INNER JOIN 
    escuela_lugarfamiliar_d1 ON historial_clinico.id_D1 = escuela_lugarfamiliar_d1.id_D1 
    INNER JOIN 
    fact_motivacion_d2 ON historial_clinico.id_D2 = fact_motivacion_d2.id_D2 
    INNER JOIN 
    fact_fisicos_d3 ON historial_clinico.id_D3 = fact_fisicos_d3.id_D3 
    INNER JOIN 
    fact_familiares_d4 ON historial_clinico.id_D4 = fact_familiares_d4.id_D4 
    INNER JOIN 
    fact_persoz_y_conduc_d5 ON historial_clinico.id_D5 = fact_persoz_y_conduc_d5.id_D5 
    INNER JOIN 
    fact_hereditarios_d6 ON historial_clinico.id_D6 = fact_hereditarios_d6.id_D6 
    INNER JOIN 
    impresion_psi_d7 ON historial_clinico.id_D7 = impresion_psi_d7.id_D7
    INNER JOIN 
    recomendaciones_d8 ON historial_clinico.id_D8 = recomendaciones_d8.id_D8
    INNER JOIN 
    plan_psicoterapeutico_d9 ON historial_clinico.id_D9 = plan_psicoterapeutico_d9.id_D9 
    WHERE 
    historial_clinico.id_histcli = (SELECT id_histcli FROM paciente WHERE id_pact = '$id_pact')";

    $buscar = mysqli_query($con, $consulta);
    if (mysqli_num_rows($buscar) > 0) {
        while ($fila = mysqli_fetch_assoc($buscar)) {
            echo "<h2>Datos de Identificacion:</h2>";
            echo "Nombre: " . $fila['D1_d1'] . "<br>";
            echo "Cedula: " . $fila['D1_d2'] . "<br>";
            echo "Fecha de Nacimiento: " . $fila['D1_d3'] . "<br>";
            echo "Telefono: " . $fila['D1_d4'] . "<br>";
            echo "Direccion: " . $fila['D1_d5'] . "<br>";
            echo "Escolaridad: " . $fila['D1_d6'] . "<br>";
            echo "Lugar que ocupa en la familia: " . $fila['D1_d7'] . "<br>";
            echo "Promedio: " . $fila['D1_d8'] . "<br>";
            echo "Escuela: " . $fila['D1_d9'] . "<br>";

            echo "<h2>Factores que Motivan a la Consulta:</h2>";
            echo "Factores Que Motivan: " . $fila['D2_d1'] . "<br>";
            echo "Referido por: " . $fila['D2_d2'] . "<br>";
            echo "Diagnostico Orgánico: " . $fila['D2_d3'] . "<br>";
            echo "Actitud De Los Padres: " . $fila['D2_d4'] . "<br>";
            echo "Estado Emocional Niño: " . $fila['D2_d5'] . "<br>";

            echo "<h2>Factores Físicos:</h2>";
            echo "Desarrollo Prenatal y Natal: " . $fila['D3_d1'] . "<br>";
            echo "Desarrollo de la Primera Infancia: " . $fila['D3_d2'] . "<br>";

            echo "<h2>Factores Familiares:</h2>";
            echo "<h3>Datos Familiares:</h3>";
            echo "<h4>Datos del Padre:</h4>";
            echo "Nombre: " . $fila['D4_d1'] . "<br>";
            echo "Salud física: " . $fila['D4_d3'] . "<br>";
            echo "Nivel educativo: " . $fila['D4_d5'] . "<br>";
            echo "Trabajo actual: " . $fila['D4_d7'] . "<br>";
            echo "Horario de trabajo: " . $fila['D4_d9'] . "<br>";
            echo "Hábitos: " . $fila['D4_d11'] . "<br>";
            echo "<h4>Datos de la Madre:</h4>";
            echo "Nombre: " . $fila['D4_d2'] . "<br>";
            echo "Salud física: " . $fila['D4_d4'] . "<br>";
            echo "Nivel educativo: " . $fila['D4_d6'] . "<br>";
            echo "Trabajo actual: " . $fila['D4_d8'] . "<br>";
            echo "Horario de trabajo: " . $fila['D4_d10'] . "<br>";
            echo "Hábitos: " . $fila['D4_d12'] . "<br>";

            echo "<h3>Experiencias Traumáticas del Niño:</h3>";
            echo "Pérdida de algún familiar o ser querido: " . $fila['D4_d13'] . "<br>";
            echo "¿Quién era?: " . $fila['D4_d14'] . "<br>";
            echo "¿Cómo fue?: " . $fila['D4_d15'] . "<br>";
            echo "Edad que tenía el niño: " . $fila['D4_d16'] . "<br>";
            echo "¿Presenció el suceso?: " . $fila['D4_d17'] . "<br>";
            echo "Reacción del niño ante esto: " . $fila['D4_d18'] . "<br>";
            echo "Accidentes del niño: " . $fila['D4_d19'] . "<br>";
            echo "Castigos graves: " . $fila['D4_d20'] . "<br>";
            echo "De parte de quién: " . $fila['D4_d21'] . "<br>";
            echo "Edad del niño: " . $fila['D4_d22'] . "<br>";
            echo "Los problemas del niño son causados por: " . $fila['D4_d23'] . "<br>";
            echo "Problemas físicos: " . $fila['D4_d24'] . "<br>";

            echo "<h2>Factores de la Personalidad y Conducta:</h2>";
            echo "<h3>Hábitos e Intereses:</h3>";
            echo "a) COMIDA: come bien, demasiado, desganado, aversiones, preferencias, etc:  " . $fila['D5_d1'] . "<br>";
            echo "b) SUEÑO: duerme bien, intranquilo, pesadillas, habla, grita en el sueño, miedo a dormir solo, prefiere dormir con el padre o madre, miedo a la obscuridad, etc:  " . $fila['D5_d2'] . "<br>";
            echo "c) ELIMINACIONES: enuresis nocturnas, diurnas, se ensucia de día o de noche, diarreas frecuentes, estreñimiento habitual, etc: " . $fila['D5_d3'] . "<br>";
            echo "d) MANÍAS Y TICS: Se come las uñas,se jala el pelo, dedos en la nariz, muecas faciales, etc: " . $fila['D5_d4'] . "<br>";
            echo "e) HISTORIA SEXUAL: masturbación, seducción, juegos sexuales, etc: " . $fila['D5_d5'] . "<br>";
            echo "f) RASGOS PECULIARES: Tendencias Destructivas: " . $fila['D5_d6'] . "<br>";

            $rasgos_caracter = [
                'D5_d7', 'D5_d8', 'D5_d9', 'D5_d10', 'D5_d11', 'D5_d12',
                'D5_d13', 'D5_d14', 'D5_d15', 'D5_d16', 'D5_d17',
                'D5_d18', 'D5_d19', 'D5_d20', 'D5_d21', 'D5_d22', 'D5_d23',
                'D5_d24', 'D5_d25', 'D5_d26', 'D5_d27', 'D5_d28', 'D5_d29',
                'D5_d30', 'D5_d31', 'D5_d32', 'D5_d33', 'D5_d34',
                'D5_d35', 'D5_d36', 'D5_d37', 'D5_d38', 'D5_d39',
                'D5_d40', 'D5_d41', 'D5_d42'
            ];
            echo "<h3>Rasgos de Carácter:</h3>";
            foreach ($rasgos_caracter as $rasgo) {
                if ($fila[$rasgo] == 1) {
                    echo str_replace("_", " ", ucfirst($rasgo)) . ": Sí<br>";
                }
            }

            echo "<h2>Factores Hereditarios:</h2>";
            echo "Incidencia de anomalías en familiares consanguíneos: " . $fila['D6_d1'] . "<br>";
            echo "Tratamiento médico por nerviosismo: " . $fila['D6_d2'] . "<br>";
            echo "Alcoholismo (grado), manifestaciones, etc: " . $fila['D6_d3'] . "<br>";
            echo "Abuso de drogas, calmantes, etc: " . $fila['D6_d4'] . "<br>";
            echo "Debilidad mental: " . $fila['D6_d5'] . "<br>";
            echo "Convulsiones, desmayos, temblores, etc: " . $fila['D6_d6'] . "<br>";
            echo "ETS (enfermedades sexuales, forma, motivos): " . $fila['D6_d7'] . "<br>";
            echo "Suicidio (formas, motivos): " . $fila['D6_d8'] . "<br>";
            echo "Anormalidades (prostitución, criminalidad, delitos, reclusión, etc): " . $fila['D6_d9'] . "<br>";
            echo "Trastornos del habla (tartamudez, sordera mudez, etc): " . $fila['D6_d10'] . "<br>";
            echo "Trastornos de la vista (ceguera, miopía, etc): " . $fila['D6_d11'] . "<br>";

            echo "<h2>Impresión Psicológica:</h2>";
            echo "Signos y síntomas, personalidad, adaptación psicológica a la enfermedad, al tratamiento, cirugía, e internamientos, relación médico-paciente-enfermera, expectativas ante la patología: " . $fila['D7_d1'] . "<br>";

            echo "<h2>Recomendaciones:</h2>";
            echo $fila['D8_d1'] . "<br>";

            echo "<h2>Plan Psicoterapéutico:</h2>";
            echo $fila['D9_d1'] . "<br>";
        }
    }else{
        echo "No se encontraron resultados para la cédula ingresada";
    }

    mysqli_close($con);
}

   
?>