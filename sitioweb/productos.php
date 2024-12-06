<?php include("template/cabecera.php"); ?>

<?php
include("administrador/config/bd.php");

$sentenciaSQL=$conexion->prepare("SELECT * FROM juegos");
$sentenciaSQL->execute();
$listaJuegos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach($listaJuegos as $juego) { ?>

<div class="col-md-3">
<div class="card">
<img class="card-img-top" src="./img/<?php echo $juego['imagen']; ?>" alt="">
<div class="card-body">
        <h4 class="card-title"><?php echo $juego['nombre']; ?></h4> <!-- ESTO ES EN LA IMAGEN, PARA QUE ME REDIRECCIONE PARA VER LA PAGINA EN DONDE PUEDO ENCONTRAR JUEGOS SIMILARES !-->
        <a name="" id="" class="btn btn-primary" href="https://www.googleadservices.com/pagead/aclk?sa=L&ai=DChcSEwiW6pm-g_mJAxV0WEgAHdyJI74YABAEGgJjZQ&co=1&ase=2&gclid=CjwKCAiA3ZC6BhBaEiwAeqfvyiDr7F8amZlxOcdDz0clz5cGbgQEth3Woglb2jN1Id-8v-0D3EpMuhoCXzwQAvD_BwE&ohost=www.google.com&cid=CAESVuD2TJAwT-3QKx089beMB5DwoWeuF1YXq6ZF3zsa1uX70lGKrzkz5QDRoEcMay6lBcTOln6cb2wa8EfL4aSI8GLDzb7zrQujjHi-9L7YoxGQuCpxCtHf&sig=AOD64_1p7RDupc0uzLsY5zJoOYwTkF53IQ&q&nis=4&adurl&ved=2ahUKEwifq5W-g_mJAxW3IbkGHRrFBSUQ0Qx6BAgQEAE" role="button"> Ver mas</a>
    
</div>    
</div>
</div>

<?php  } ?>


<?php include("template/pie.php"); ?>
