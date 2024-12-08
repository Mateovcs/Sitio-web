<?php
session_start();  //INICIA SESION
 if(!isset($_SESSION['usuario'])){ //comprueba si NO se INICIO UNA SESION Y REVISA QUE NOMBRE SE INGRESO, (POR ESO LE PUSE UN "name" al usuario)
    header("Location:../index.php"); //REDIRECCIONA AL "index.php"
 }else{
    if($_SESSION['usuario']=="ok"){ //EN CASO DE QUE EL USUARIO COINCIDE CON EL nombre "jimena", guarda ese inicio de sesion y la contraseña tambien
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
    <title>Pestaña de Administrador</title>

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/> <!-- BOOTSTRAP -->
</head>
<body>

    <?php $url="https://".$_SERVER['HTTP_HOST']."/sitioweb" ?> <!-- ESTO ES PARA QUE SI QUIERO VOLVER A LA PAGINA DEL INICIO (la de la foto de abuela) CON UN SOLO CLICK -->
    
    <nav class="navbar navbar-expand navbar-light bg-light">  
    <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Administrador de la web<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url;?> /administrador/inicio.php">Inicio</a>
            <a class="nav-item nav-link" href="<?php echo $url;?> /administrador/seccion/productos.php">libros</a>
            <a class="nav-item nav-link" href="<?php echo $url;?> /administrador/seccion/cerrar.php">Cerrar</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>">Ver sitio web</a>

            <!-- SON LOS BOTONES DE ARRIBA DE LA PAGINA, Y SI LE DAS CLICK TE REDIRECCIONA A DISTINTOS LUGARES -->
            
    </div>
    </nav>
    
    <div class="container">
        <div class="row">
