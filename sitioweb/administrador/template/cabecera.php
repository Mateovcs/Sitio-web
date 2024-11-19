<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sitio Web</title>
    
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
</head>
<body>

    <?php $url="https://".$_SERVER['HTTP_HOST']."/sitioweb" ?>
    
    <nav class="navbar navbar-expand navbar-light bg-light">  
    <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Administrador de la web<span class</a>
            <a class="nav-item nav-link" href="<?php echo $url; ?> /administrador/inicio.php">Inicio</a>
            <a class="nav-item nav-link" href="<?php echo $url;?> /administrador/seccion/productos.php">Juegos</a>
            <a class="nav-item nav-link" href="<?php echo $url;?> /administrador/seccion/cerrar.php">Cerrar</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>">Ver sitio web</a>
            
    </div>
    </nav>
    
    <div class="container">
        <div class="row">
