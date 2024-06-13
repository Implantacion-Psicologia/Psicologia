<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Style-frente.css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap"
    rel= "stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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



  #titulo-e h1{
    color:#64b468;
    text-align: center;
  }

  #titulo-e{
    color:#000000;
    text-align: center;

  }

  .caja-texto{
    border:2px solid #dbdbdb;
    background-color: #ffffff;
    padding: 30px;
    margin: 30px;
    width: 300px;
    border-radius: 2%;
    box-sizing: content-box;


    display: block;
    margin-left: auto;
    margin-right: auto;

    
  }

  button {
    margin: 5px;
    background-color: #60bf65;

  }

  



</style>


<!-- Barra de selección -->
<div id="barraSeleccion">
  <ul>
    
    <li><a href="datosRegistro.php">Registro</a></li>
    <li><a href="login.php">Acceder</a></li>
    <li><a href="acerca-de.html">Acerca de</a></li>
    
  </ul>
</div>







        
    </div>
</head>
<body>
    <br><br><br>
    
  <div id="titulo-e">
    <h2>
      ¿Quieres formar parte de nuestra familia?
    </h2>

    <h1 >
        Emoción Vital
    </h1>


    <div class="caja-texto">
      <h5>Ayudenos a encontrarle el psicologo adecuado.</h5>
      <hr>

      <div>
        <h3>¿Que tipo de consulta desea?</h3>
        <a href="login.php">
        <button type="button" > Consulta Individual </button>
        
        <a href="login.php">
        <button type="button" > Consulta de Pareja </button>
        
        <a href="login.php">
        <button type="button" > Consulta para Niños </button>
</a>
        <br><hr>
      </div>



      
    <div>
        "Cuidarte es impotante par tu bienestar emocional. 
        Aprende a priorizar tus necesidades y hacer tiempo 
        para ti mismo. recuerda que no puedes cuidar a los demas 
        si no te cuidas a ti mismo".
    </div>


    </div>
    
  
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>