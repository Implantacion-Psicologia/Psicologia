<?php

$user="root";
$pass="";
$server="localhost";
$db="emocion_vital";
$con=mysqli_connect($server, $user, $pass, $db) or die ("No se pudo conectar ".mysqli_error());
if($con->connect_error){
    die("Connection failet: " .$con->connect_error);
}

$muninipio_selec = "";
$consulta = "SELECT municipios.id_municipio, municipios.municipio, estados.id_estado 
FROM municipios INNER JOIN estados ON municipios.id_estado = estados.id_estado";
$ejecut = mysqli_query($con, $consulta);
if (mysqli_num_rows($ejecut) > 0){
    $muninipio_selec .= "<option value=''>Seleccionar>/option>";
    while($rom = mysqli_fetch_assoc($ejecut)){
        $id_municipio = $rom["id_municipio"];
        $nom_municipio = $rom["municipio"];
        $estado = $rom["estado"];
        $muninipio_selec .= "<option value='$id_municipio'>$nom_municipio($estado)>/option>";
    }
}else{
    $selec_municipio = "<option value=''>No se han encontrado Municipios...>/option>";
}

$estado_selec= "";
$consulta = "SELECT id_estado, estado FROM estados";
$ejecut = mysqli_query($con, $consulta);
if(mysqli_num_rows($ejecut) > 0){
    $estado_selec = "<option value=''>Seleccionar>/option>";
    while($rom = mysqli_fetch_assoc($ejecut)){
        $id_estado .= $rom["id_estado"];
        $nom_estado = $rom["estado"];
        $estado_selec .= "<option value='$id_estado'>$nom_estado>/option>";
    }
}else{
    $estado_selec = "<option value=''>No se han encontrado Estados>/option>";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Registro </title>
        <link rel="stylesheet" href="Style.css"/>
        <meta charset="utf-8">
    </head>
    
<body>
    <header> 
        <br>
        <br>
        <img src="registro-ico.png" width="100"/>
        <h1>Registro </h1>
    </header>
    


    
    <form id="register" method="post" action="registro.php">
        
        
        <!-- name -->
        <Label for = "nombre"> </Label>
        <input type ="text" id= "nombres" name ="nombres" required
        placeholder = "Nombres"/>
        
        <br>
        
        <!-- surname -->
        <Label for = "apellido"> </Label>
        <input type ="text" id= "apellidos" name ="apellidos" required
        placeholder = "Apellidos"/>

        <br>

        
        <!-- cedula -->
        <div class="cedula" requiered>
            <label for="tipo_ced"></label>
            <select name="tipo_ced" id="languages">
            <option value="V">V</option>
            <option value="E">E</option>
            <option value="J">J</option>
            </select>
        
            
            <Label for = "cedula"></Label>
            <input type ="number" id= "cedula" name ="cedula" required
            placeholder = "Cedula"/>
        </div>
        <br>

        <!-- Tlf -->
        <Label for = "Telefono"></Label>
        <input type ="text" id= "tlf" name ="tlf" required
        placeholder = "Telefono" />
        <p>
            Direccion
        </p>

        <label for="estado">Estados: </label>
        <select id="estado" name="estado" id="languages" required onchange="MuestraMunicipio()">
        <option value="">Seleccionar Estado</option>
        <?php echo $estado_selec; ?>
        </select>

        <br>

        <label for="municipio">Municipios: </label>
        <select id="municipio" name="municipio" id="languages" require disabled>
        <option value="">Seleccionar Municipio</option>
        <?php echo $municipio_selec; ?>
        </select>

        <br>
        <p>
            Fecha de Nacimiento
        </p>

        <!-- Male selection-->
        <div class="edad" requiered>   
            
            <select name="dias" id="dias">
                <option value="">Día</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
            </select>
            
            <select name="mes" id="mes">
                <option value="">Mes</option>
                <option value="01">ENERO</option>
                <option value="02">FEBRERO</option>
                <option value="03">MARZO</option>
                <option value="04">ABRIL</option>
                <option value="05">MAYO</option>
                <option value="06">JUNIO</option>
                <option value="07">JULIO</option>
                <option value="08">AGOSTO</option>
                <option value="09">SEPTIEMBRE</option>
                <option value="10">OCTUBRE</option>
                <option value="11">NOVIEMBRE</option>
                <option value="12">DICIEMBRE</option>
            </select>
            
            <select name="años" id="años">
                <option value="">Año</option>
                <option value="1930">1930</option>
                <option value="1931">1931</option>
                <option value="1932">1932</option>
                <option value="1933">1933</option>
                <option value="1934">1934</option>
                <option value="1935">1935</option>
                <option value="1936">1936</option>
                <option value="1937">1937</option>
                <option value="1938">1938</option>
                <option value="1939">1939</option>
                <option value="1940">1940</option>
                <option value="1941">1941</option>
                <option value="1942">1942</option>
                <option value="1943">1943</option>
                <option value="1944">1944</option>
                <option value="1945">1945</option>
                <option value="1946">1946</option>
                <option value="1947">1947</option>
                <option value="1948">1948</option>
                <option value="1949">1949</option>
                <option value="1950">1950</option>
                <option value="1951">1951</option>
                <option value="1952">1952</option>
                <option value="1953">1953</option>
                <option value="1954">1954</option>
                <option value="1955">1955</option>
                <option value="1956">1956</option>
                <option value="1957">1957</option>
                <option value="1958">1958</option>
                <option value="1959">1959</option>
                <option value="1960">1960</option>
                <option value="1961">1961</option>
                <option value="1962">1962</option>
                <option value="1963">1963</option>
                <option value="1964">1964</option>
                <option value="1965">1965</option>
                <option value="1966">1966</option>
                <option value="1967">1967</option>
                <option value="1968">1968</option>
                <option value="1969">1969</option>
                <option value="1970">1970</option>
                <option value="1971">1971</option>
                <option value="1972">1972</option>
                <option value="1973">1973</option>
                <option value="1974">1974</option>
                <option value="1975">1975</option>
                <option value="1976">1976</option>
                <option value="1977">1977</option>
                <option value="1978">1978</option>
                <option value="1979">1979</option>
                <option value="1980">1980</option>
                <option value="1981">1981</option>
                <option value="1982">1982</option>
                <option value="1983">1983</option>
                <option value="1984">1984</option>
                <option value="1985">1985</option>
                <option value="1986">1986</option>
                <option value="1987">1987</option>
                <option value="1988">1988</option>
                <option value="1989">1989</option>
                <option value="1990">1990</option>
                <option value="1991">1991</option>
                <option value="1992">1992</option>
                <option value="1993">1993</option>
                <option value="1994">1994</option>
                <option value="1995">1995</option>
                <option value="1996">1996</option>
                <option value="1997">1997</option>
                <option value="1998">1998</option>
                <option value="1999">1999</option>
                <option value="2000">2000</option>
                <option value="2001">2001</option>
                <option value="2002">2002</option>
                <option value="2003">2003</option>
                <option value="2004">2004</option>
                <option value="2005">2005</option>
                <option value="2006">2006</option>
                <option value="2007">2007</option>
                <option value="2008">2008</option>
                <option value="2009">2009</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
                <option value="2029">2029</option>
                <option value="2030">2030</option>
            </select>
        </div> 
        <br>

        <!-- E.mail -->
        <Label for = "Correo"></Label>
        <input type ="text" id= "correo" name ="correo" required
        placeholder = "Correo" />

        <br>

        <!-- password -->
        
        <label for = "contraseña"></label>
        <input id = "contraseña" name = "contraseña" type = "password" requiered
        placeholder="Contraseña"/>
        
        
        <br>

        <!-- password verification-->
        <label for = "verifica contraseña"> </label>
        <input id = "verifica contraseña" name = "verifica contraseña" type = "password" required
        placeholder ="Verifica contraseña"/>

        <br>

        <div class="enviar">
            <input type ="submit" value = "Registrarse" />
        </div>
    
    </form>

</body>
<footer>
    
    <p>¿Ya estas resgistrado? <a href="login.html" >Inicia sesion</a></p>
    <p>Volver al <a href="index.html" >inicio</a></p>
    <p>Copyrigt 2024</p>
</footer>



</html>

<script>
    function(MuestraMunicipio){
        var option_estado = document.getElementById(estado);
        var option_municipios = document.getElementById(municipio);
        option_municipios.disable = option_estado.value === "";
    }
<script>
