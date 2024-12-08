<?php
$host="localhost";
$bd="libreria";
$usuario="root";   //EN POCAS PALABRAS ACA VINCULO MI BASE DE DATOS
$contrasenia="";

try {
        $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia );
        
} catch ( Exception $ex) { //PARA EJECUTAR LA BASE DE DATOS
    
    echo $echo->getMessage();
}
?>

<!-- Con esto concluye la explicacion del codigo, buena suerte con base de datos -->