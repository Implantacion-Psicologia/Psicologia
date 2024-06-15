<!DOCTYPE html>
<html lang="es">

<title> Buscar Historial </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="Style.css"/>
<meta charset="utf-8">


<title>Buscar Historial Clinico</title>
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
      color: white; /* Color del texto */
    }

    /* Cambia el color de fondo al pasar el mouse */
    #barraSeleccion li a:hover {
      background-color: #9eb952;
    }

    /* Estilos para la tabla */
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
  
</head>

<body>
  <!-- Barra de selección -->
  <div id="barraSeleccion">
    <ul>
      <li><a href="index-psi.html">Volver al Menu</a></li>
    </ul>
  </div>

  <header>
    <br><br>
    <h1>Busqueda y Muestra del Historial</h1>
  </header>
  
  <form class="row g-1 needs-validation" action="buscarHistorialCli.php" novalidate id="busqueda" method="GET">
    <div class="form-control rounded col-md-6">
      <label for="buscarcedula"></label>
      <input type="text" id="buscarcedula" name="cedula" required pattern="[0-9]+" placeholder="Cédula"/>
      <div class="valid-feedback">¡Todo Correcto!</div>
      <div class="invalid-feedback">Ingrese solo números</div>
    </div>

    <div class="form-control rounded col-md-4">
      <button type="button" onclick="buscarHistorial()">Buscar</button>
      <br><br>
      <button type="button" onclick="limpiar()">Limpiar Datos</button>
    </fiv>

   </form>

  <!-- Resultado de la Busqueda -->
  <div id="mostrar"></div>
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
    })();

    function limpiar() {
      document.getElementById('busqueda').reset();
      document.getElementById('mostrar').innerHTML = ''; 
    }

    function buscarHistorial() {
      var form = document.getElementById('busqueda');
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
        form.classList.add('was-validated');
        return;
      }
      form.classList.add('was-validated');

      var cedula = document.getElementById('buscarcedula').value;
      if (!cedula) {
        alert('Ingrese una cédula para realizar la búsqueda');
        return;
      }
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            document.getElementById('mostrar').innerHTML = xhr.responseText;
          } else {
            alert('Error al realizar la búsqueda. Inténtelo de nuevo.');
          }
        }
      };
      xhr.open('GET', 'buscarHistorialCli.php?cedula=' + cedula, true);
      xhr.send();
    }
  </script>
</body>
</html>
