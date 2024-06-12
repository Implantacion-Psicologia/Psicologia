<!DOCTYPE html>
<html lang="es">
<head>
    <title>Historial Clinico</title>
    <link rel="stylesheet" href="Style-frente.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="utf-8">
    <head>
        <style>
          /* Estilos para la barra de selección */
          #barraSeleccion {
            position: fixed; /* Fija la barra en la pantalla */
            top: 0; /* Alinea la barra en la parte superior */
            left: 0; /* Alinea la barra a la izquierda */
            width: 100%; /* Ancho completo */
            background-color: #64b468; /* Color de fondo */
            color: white; /* Color del texto */
            z-index: 1000; /* Asegura que la barra esté sobre otros elementos */
          }
        
          /* Estilos para los elementos dentro de la barra */
          #barraSeleccion ul {
            list-style-type: none; /* Remueve los estilos de lista */
            margin: 0;
            padding: 0;
            overflow: hidden;
          }
        
          #barraSeleccion li {
            float: left; /* Alinea los elementos horizontalmente */
          }
        
          #barraSeleccion li a {
            display: block; /* Hace que los enlaces llenen el espacio del 'li' */
            text-align: center; /* Centra el texto */
            padding: 14px 16px; /* Espaciado interno */
            text-decoration: none; /* Remueve el subrayado del enlace */
          }
        
          /* Cambia el color de fondo al pasar el mouse */
          #barraSeleccion li a:hover {
            background-color: #9eb952;
          }
        </style>
        
        
          <!-- Barra de selección -->
          <div id="barraSeleccion">
            <ul>
              <li><a href="index-psi.html">Volver al Menu</a></li>
            </ul>
          </div>
        
          <title>Lista de Consultas</title>
          <style>
              table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
          }
      
          th {
              background-color: #e6f2ff; 
              color: #333;
              border: 1px solid #dddddd;
              text-align: left;
              padding: 8px;
          }
      
          td {
              background-color: #ffffff; 
              color: #333;
              border: 1px solid #dddddd;
              text-align: left;
              padding: 8px;
          }
          </style>
          <link rel="stylesheet" href="Style.css"/>
          <meta charset="utf-8">
      </head>
        <br>
        <br>
        <div class="listaConsulta">
            <h1>Registro del Historial Clinico</h1>
            <br>
        <div>
    </header>
    <body>
    <form class="needs-validation" novalidate id= "HistorialClinico" method="POST" action="guardarHistClin.php">

        <div>
            <h3>I. DATOS DE IDENTIFICACIÓN</h3>
            <div>
                <?php //buscar como hacer que agarre espacios incluidos ?>
                <label>Nombre: </label>
                <Label for = ""> </Label>
                <input type ="text" name ="nombre" required pattern="[A-Za-z]+"/>
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
                <br>
            <div>
                <label> Cedula: </label> 
                <Label for=""></label>
                <input type="text" name = "cedula" required pattern = "[0-9]+"/>
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Numeros</div>
            </div>
                <br>
            <div class="form-floating mb-3">
                <label> Fecha de Nacimiento: </label> 
                <br><br>
                <Label for=""></label>
                <input type="date" name="fechanac" required max="<?php echo date('Y-m-d',strtotime('-1 day')); ?>"/>
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Seleccione una Fecha Valida</div>
            </div>
                <br>
                <br>
            <div>
                <label> Direccion:</label> 
                <Label for=""></label>
                <input type="text" name="direccion" required/>
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese algun Dato</div>
            </div>
                <br>
            <div>
                <label> Telefono: </label> 
                <Label for=""></label>
                <input type="text" name="telefono" required pattern = "[0-9]+"/>
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Numeros</div>
            </div>
                <br>
                <br>
            <div>
                <label> Es caso de ser un infante... ¿Esta Escolarizado? </label> 
                <Label for="tipoced"></label>
                <input type="text" name="escolaridad" required pattern = "(Si|No)$" placeholder = "Si o No">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">La respuesta debe ser Sí o No</div>
            </div>
                <br>

            <div>
                <label> Escuela: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="escuela" required>
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese algun Dato</div>
            </div>
                <br>
                <br>
            <div>
                <label> Promedio: </label> 
                <Label for="tipoced"></label>
                <input type="number" name="promedio" requerid pattern="[0-9]+(\.[0-9]{1,2})?" min="0.00" max="20.00" placeholder="0.00">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">El promedio debe ser un número entre 0.00 y 20.00 con dos decimales</div>
            </div>
                <br>

                <br>
            <div>
                <label> Lugar que ocupa en la familia: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="lugarfamilia" required pattern = "[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
                <br>
                <br>

        </div>

        <div>
            <h3>II. FACTORES QUE MOTIVAN A LA CONSULTA</h3>
            <div>
            <div>
                <label> Motivo de Consulta: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="motivocon" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
                <br>
            <div>
                <label> Referido por :</label> 
                <Label for="tipoced"></label>
                <input type="text" name="referido" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
                <br>
            <div>
                <label> Diagnostico Organico:</label> 
                <Label for="tipoced"></label>
                <input type="text" name="diagorganico" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
                <br>
            <div>
                <p>En caso de ser infante: </p>
                <label> ¿Si o No?</label> 
                <Label for="tipoced"></label>
                <input type="text" name="desicion" required pattern = "(Si|No)$" placeholder = "Si o No">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">La respuesta debe ser Sí o No</div>
            </div>
            <br>
            <div>
                <label> Actitud de los padres ante el problema :</label> 
                <Label for="tipoced"></label>
                <input type="text" name="actitudpadres" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
                <br>
            <div>
                <label> Estado emocional actual del Niño(a): </label> 
                <Label for="tipoced"></label>
                <input type="text" name="estadoemocionalniño" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
                <br><br>
            </div>
        </div>

        <div>
            <h3>III. FACTORES FÍSICOS</h3>
            <div>
                <label> Desarrollo Natal y Prenatal: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="desarrolloprental" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            
                <br>
            <div>
                <label> Desarrollo de la Primera Infancia:</label> 
                <Label for="tipoced"></label>
                <input type="text" name="desarolloinfancia" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            <div>
                <br><br>
            </div>
        </div>

        <div>
            <h3>IV. FACTORES FAMILIARES</h3>
            <div>
                <h4>Parte 1: Datos Familiares</h4>
                <p>Del Padre</p>
            <div>
                <label> Nombre: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="nombrepadre" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Salud Fisica: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="saludpadre" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Nivel Educatico: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="educativopadre" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Trabajo Actual: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="trabajopadre" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Horario de Trabajo: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="horariopadre" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Habitos: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="habitospadre" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
                <br><br>
            <div>
                <p>De la Madre</p>
                <label> Nombre: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="nombrem" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>    
                <label> Salud Fisica: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="saludmadre" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Nivel Educatico: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="educativomadre" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Trabajo Actual: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="trabajomadre" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Horario de Trabajo: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="horariomadre" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Habitos: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="habitosmadre" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
                <br><br>
            </div>
            <div>

                <h4>Parte 2: Experiencia Traumatica del Niño (En caso de que lo sea)</h4>
            <div>
                <label> ¿El niño a experimentado la perdida de un familiar? </label> 
                <Label for="tipoced"></label>
                <input type="text" name="perdidafamilia" required pattern="(Si|No)$" placeholder = "Si o No">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">La respuesta debe ser Sí o No</div>
            </div>
                <p>Nota: En caso de que sea "No" ignore la siguientes 5 preguntas</p>
            <div>
                <label> Quien era: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="perdidaquien" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Como fue: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="comofue" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <br><br>
                <label> Edad que tenía el niño: </label> 
                <Label for="tipoced"></label>
                <input type="number" name="edadniño1" required patthern = "[0-9]+" min="5" max="17">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">La Edad es Invalida, Ingrese una Edad Correcta</div>
            </div>
            <div>
                <br><br>
                <label> Presencio el suceso: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="presenciasuceso" required pattern="(Si|No)$" placeholder = "Si o No">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">La respuesta debe ser Sí o No</div>
            </div>
            <div>
                <label> Reacción del niño ante esto: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="reaccionsuceso" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> El Niño ha Sufrido Accidentes: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="accidenteniño" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Castigos Graves: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="castigoniño" required pattern="(Si|No)$" placeholder = "Si o No">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">La respuesta debe ser Sí o No</div>
            </div>
                <p>Nota: En caso de que sea "No" ignore la siguientes 2 preguntas</p>
            <div>
                <label> De parte de quien: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="castigoquien" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <br><br>
                <label> Edad del niño: </label> 
                <Label for="tipoced"></label>
                <input type="number" name="edadniño2" required patthern = "[0-9]+" min="5" max="17">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">La Edad es Invalida, Ingrese una Edad Correcta</div>
            </div>
            <div>
                <br><br>
                <label> Los problemas del niño son causados por (personas,
                    situaciones, experiencias, etc): </label> 
                <Label for="tipoced"></label>
                <input type="text" name="problemasniño" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Problemas Físicos :</label> 
                <Label for="tipoced"></label>
                <input type="text" name="problemafisico" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
                
                <br><br>
            </div>
        </div>

        <div>
            <h3>V. FACTORES DE LA PERSONALIDAD Y CONDUCTA</h3>
            <div>
                <h4>Parte 1: Habitos e Intereses</h4>
            <div>
                <label> En la Comida: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="comida" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div> 
                <label> En el Sueño: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="sueño" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> En las Eliminaciones: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="eliminarcion" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> En las Manias y Tics: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="maniastics" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> En su Historia Sexual: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="sexual" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> En los Rasgos Peculiares: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="peculiares" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>

            </div>

            <h4>Parte 2: Rasgos de Caracter</h4>
            
            <div class="form-check">
                <label><input type="checkbox" name="timido" value="Timido">Tímido</label>
                <label><input type="checkbox" name="agresivo" value="Agresivo">Agresivo</label>
                <label><input type="checkbox" name="tranquilo" value="Tranquilo">Tranquilo</label>
                <label><input type="checkbox" name="irritable" value="Irritable">Irritable</label>
                <label><input type="checkbox" name="alegre" value="Alegre">Alegre</label>
                <label><input type="checkbox" name="triste" value="Triste">Triste</label>
                <label><input type="checkbox" name="cooperativo" value="Cooperador">Cooperador</label>
                <label><input type="checkbox" name="negativista" value="Negativista">Negativista</label>
                <label><input type="checkbox" name="sereno" value="Sereno">Sereno</label>
                <label><input type="checkbox" name="impulsivo" value="Impulsivo">Impulsivo</label>
                <label><input type="checkbox" name="confiado" value="Confiado">Confiado en sí</label>
                <br><br>
                <label><input type="checkbox" name="frio" value="Frio">Frío</label>
                <label><input type="checkbox" name="sociable" value="Sociable">Sociable</label>
                <label><input type="checkbox" name="retardado" value="Retardado">Retardado</label>
                <label><input type="checkbox" name="equilibrado" value="Equilibrado">Equilibrado</label>
                <label><input type="checkbox" name="nervioso" value="Nervioso">Nervioso</label>
                <label><input type="checkbox" name="cariñoso" value="Carinoso">Cariñoso</label>
                <label><input type="checkbox" name="inseguro" value="Inseguro">Inseguro</label>
                <label><input type="checkbox" name="juega" value="Juega">Juega</label>
                <label><input type="checkbox" name="nojuega" value="No_juega">No juega</label>
                <label><input type="checkbox" name="controlado" value="Controlado">Controlado</label>
                <label><input type="checkbox" name="emotivo" value="Emotivo">Emotivo</label>
                <label><input type="checkbox" name="seguro" value="Seguro">Seguro</label>
                <br><br>
                <label><input type="checkbox" name="amable" value="Amable">Amable</label>
                <label><input type="checkbox" name="desconsiderado" value="Desconsiderado">Desconsiderado</label>
                <label><input type="checkbox" name="laborioso" value="Laborioso">Laborioso</label>
                <label><input type="checkbox" name="perezoso" value="Perezoso">Perezoso</label>
                <label><input type="checkbox" name="desconfiado" value="Desconfiado">Desconfiado</label>
                <label><input type="checkbox" name="dominante" value="Dominante">Dominante</label>
                <label><input type="checkbox" name="sumiso" value="Sumiso">Sumiso</label>
                <label><input type="checkbox" name="disciplinado" value="Disciplinado">Disciplinado</label>
                <label><input type="checkbox" name="indisiplinado" value="Indisciplinado">Indisciplinado</label>
                <label><input type="checkbox" name="rebelde" value="Rebelde">Rebelde</label>
                <br><br>
                <label><input type="checkbox" name="obediente" value="Obediente">Obediente</label>
                <label><input type="checkbox" name="ordenado" value="Ordenado">Ordenado</label>
                <label><input type="checkbox" name="desordenado" value="Desordenado">Desordenado</label>
            </div>

                <br><br>
        </div>

        <div>
            <h3>VI. FACTORES HEREDITARIOS</h3>
            <div>
                
            <div>
                <label> Incidencia de Anomalias en Familiares Consanguineos (Familiares, Fecha,Detalles,etc): </label> 
                <Label for="tipoced"></label>
                <input type="text" name="incidencia" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Tratamiento Medico por Nerviosismo: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="tratamientonervios" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Alcolismo (Grado), Manifestaciones, etc: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="alcohol" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Abuso de drogas, Calmantes, etc: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="drogas" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Debilidad Mental: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="debilmental" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Convulsiones, Desmayos, Templores, etc: </label> 
                <Label for="tipoced"></label>
                <input type="text" name="convulsion" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> ETS - Enfermedades Sexuales (Forma, Motivos): </label> 
                <Label for="tipoced"></label>
                <input type="text" name="enfermedadsexo" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Suicidio (Formas, Motivos): </label> 
                <Label for="tipoced"></label>
                <input type="text" name="suicidio" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Anormalidades (ProntitucionN, Criminalidad, Delitos, Reclusion, etc): </label> 
                <Label for="tipoced"></label>
                <input type="text" name="anormalidad" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Transtornos del Habla (Tartamudez, Sodera, Mudez, etc): </label> 
                <Label for="tipoced"></label>
                <input type="text" name="transtorno" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <div>
                <label> Trasornos de la Vista (Ceguera, Miopia, etc): </label> 
                <Label for="tipoced"></label>
                <input type="text" name="trasorno" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
                <br><br>
            </div>
        </div>

        <div>
            <h3>VII. IMPRESIÓN PSICOLÓGICA</h3>
            <div>
                <label> Refiriendonos a Signos y síntomas, personalidad, adaptación psicológica a la enfermedad, al tratamiento,
                    cirugía, e internamientos, relación médico -paciente-enfermera, expectativas ante la
                    patología: </label> 
                    <br><br>
                <Label for="tipoced"></label>
                <input type="text" name="impresion" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <br><br>
        </div>

        <div>
            <h3>VIII. RECOMENDACIONES</h3>
            <div>
                <label></label> 
                <Label for="tipoced"></label>
                <input type="text" name="recomendacion" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <br><br>
        </div>

        <div>
            <h3>IX. PLAN PSICOTERAPÉUTICO</h3>
            <div>
                <label></label> 
                <Label for="tipoced"></label>
                <input type="text" name="plan" required pattern="[A-Za-z]+">
                <div class="valid-feedback">¡Todo Correcto!</div>
                <div class="invalid-feedback">Ingrese solo Letras</div>
            </div>
            <br><br>
        </div>

        <br><br>
        <input type="submit" name="Save" value="Guardar">
    </form>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    (function () {
  'use strict'

  var forms = document.querySelectorAll('.needs-validation')

  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()    
</script>

<script>
    const escolaridadSelect = document.querySelector('input[name="escolaridad"]');
    const escuelaInput = document.querySelector('input[name="escuela"]');
    const promedioInput = document.querySelector('input[name="promedio"]');

    escolaridadSelect.addEventListener('change', handleEscolaridadChange);

    function handleEscolaridadChange() {
        const respuesta = escolaridadSelect.value;
        escuelaInput.disabled = respuesta !== 'Si';
        promedioInput.disabled = respuesta !== 'Si';
    }

    const desicionSelect = document.querySelector('input[name="desicion"]');
    const actitudPadresInput = document.querySelector('input[name="actitudpadres"]');
    const estadoEmocionalNinoInput = document.querySelector('input[name="estadoemocionalniño"]');

    desicionSelect.addEventListener('change', handleDesicionChange);

    function handleDesicionChange() {
        const respuesta = desicionSelect.value;
        actitudPadresInput.disabled = respuesta !== 'Si';
        estadoEmocionalNinoInput.disabled = respuesta !== 'Si';
    }

    const perdidaFamiliarSelect = document.querySelector('input[name="perdidafamilia"]');
    const perdidaQuienInput = document.querySelector('input[name="perdidaquien"]');
    const comoFueInput = document.querySelector('input[name="comofue"]');
    const edadNino1Input = document.querySelector('input[name="edadniño1"]');
    const presenciaSucesoInput = document.querySelector('input[name="presenciasuceso"]');
    const reaccionSucesoInput = document.querySelector('input[name="reaccionsuceso"]');

    perdidaFamiliarSelect.addEventListener('change', handlePerdidaFamiliarChange);

    function handlePerdidaFamiliarChange() {
        const respuesta = perdidaFamiliarSelect.value;
        perdidaQuienInput.disable = respuesta !== 'Si';
        comoFueInput.disable = respuesta !== 'Si';
        edadNino1Input.disable = respuesta !== 'Si';
        presenciaSucesoInput.disable = respuesta !== 'Si';
        reaccionSucesoInput.disable = respuesta !== 'Si';
    }

    const castigoNinoSelect = document.querySelector('input[name="castigoniño"]');
    const castigoQuienInput = document.querySelector('input[name="castigoquien"]');
    const edadNino2Input = document.querySelector('input[name="edadniño2"]');

    castigoNinoSelect.addEventListener('change', handleCastigoNinoChange);

    function handleCastigoNinoChange() {
        const respuesta = castigoNinoSelect.value;
        castigoQuienInput.disable = respuesta !== 'Si';
        edadNino2Input.disable = respuesta !== 'Si';
    }
</script>