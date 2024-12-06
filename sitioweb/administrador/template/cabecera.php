<?php
session_start();  //INICIA SESION
 if(!isset($_SESSION['usuario'])){
    header("Location:../index.php"); //REDIRECCIONA AL "index.php"
 }else{

    if($_SESSION['usuario']=="ok"){
        if (isset($_SESSION['nombreUsuario'])){
        $nombreUsuario=$_SESSION["nombreUsuario"];
    }
}
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Biblioteca</title>

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/> <!-- BOOTSTRAP -->
</head>
<body>

    <?php $url="https://".$_SERVER['HTTP_HOST']."/sitioweb" ?>
    
    <nav class="navbar navbar-expand navbar-light bg-light">  
    <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Administrador de la web<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url;?> /administrador/inicio.php">Inicio</a>
            <a class="nav-item nav-link" href="<?php echo $url;?> /administrador/seccion/productos.php">libros</a>
            <a class="nav-item nav-link" href="<?php echo $url;?> /administrador/seccion/cerrar.php">Cerrar</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>">Ver sitio web</a>
            
    </div>
    </nav>
    
    <div class="container">
        <div class="row">
