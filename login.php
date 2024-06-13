<!DOCTYPE html>

<html>

    <style>
    .caja{
        border:2px solid #dbdbdb;
        background-color: #ffffff;
        padding: 50px;
        margin: 50px;
        width: 300px;
        border-radius: 2%;
        box-sizing: content-box;


        display: block;
        margin-left: auto;
        margin-right: auto;

        
        }
    
    </style>



    <head>
        <title> inicio </title>
        <link rel="stylesheet" href="Style.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <meta charset="utf-8">
    </head>

   

    <header class="text-center"> 
        <br>
        <img  src="usuario.png" width="100"/>
        <h1> Inicio </h1>
    </header>
    


<div class="caja">     
    <body>
        <form id="login" method="post" action="iniciarsesion.php">
        
        <!-- E.mail -->
        <Label for = "Correo"></Label>
        <input class="col-md-2 form-control rounded" type ="text" id= "correo" name ="correo" required
        placeholder = "Correo" />
        
        
        
        <!-- password -->
        
        <label for = "contraseña"></label>
        <input class="col-md-2 form-control rounded" id = "contraseña" name = "contraseña" type = "password" requiered
        placeholder="Contraseña"/>

        <br>
        
        <div class="enviar">
            <input type ="submit" value = "Iniciar Sesion" />
        </div>

        
    
    </form>

    </body>
    <footer>
        <br>
        <a href="Rec-contra.html" >¿Olvidaste tu contraseña?</a></p>
        <p>¿Ya estas resgistrado? <a href="datosRegistro.php">Registrarse</a></p>
        <p>Volver al <a href="index.php" >inicio</a></p>
        <p>Copyrigt 2024</p>
    </footer>
</div>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
