<?php include("template/cabecera.php"); ?>

<?php
include("administrador/config/bd.php");

$sentenciaSQL=$conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaLibros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach($listaLibros as $libro) { ?>

<div class="col-md-3">
<div class="card">
<img class="card-img-top" src="./img/<?php echo $libro['imagen']; ?>" alt="">
<div class="card-body">
        <h4 class="card-title"><?php echo $libro['nombre']; ?></h4> <!-- ESTO ES EN LA IMAGEN, PARA QUE ME REDIRECCIONE PARA VER LA PAGINA EN DONDE PUEDO ENCONTRAR JUEGOS SIMILARES !-->
        <a name="" id="" class="btn btn-primary" href="https://www.casadellibro.com/libros-ebooks-gratis/184?srsltid=AfmBOoryPYijFy4fbYmvyYA3yNkd5CsWL0ES6hRHM31yAlUBBaI-bMFw" role="button"> Ver mas libros</a>
    
</div>    
</div>
</div>

<?php  } ?>


<?php include("template/pie.php"); ?>
