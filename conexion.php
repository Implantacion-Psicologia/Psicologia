<?php

function conectar(){
    $user="root";
    $pass="";
    $server="localhost";
    $db="emocion_vital";
    $con=mysqli_connect($server, $user, $pass, $db) or die ("No se pudo conectar ".mysqli_error());
}
return $con;

?>