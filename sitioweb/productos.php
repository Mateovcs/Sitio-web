<?php include("template/cabecera.php"); ?> <!-- Esto sera el boton o opcion "Libros" !-->


<?php
include("administrador/config/bd.php");  //ESTO ES PARA QUE EN EL MODO ADMINISTRADOR nos aparezcan los libros que ya estan cargados

$sentenciaSQL=$conexion->prepare("SELECT * FROM libros"); //MUESTRA LOS LIBROS QUE YA ESTAN CARGADOS, y se crea una variable llamada "$conexion" para que prepare esos datos, vos sabes ingles asi que lo entendes
$sentenciaSQL->execute(); //EJECUTA la instruccion para MOSTRAR los libros
$listaLibros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC); //LAS CONSULTAS HECHAS COMO EL "SELECT" seran ASOCIADAS en la variable "$listaLibros" por el metodo PDO (MANIPULACION DE DATOS)
?>

<?php foreach($listaLibros as $libro) { ?> <!-- El "Foreach" es para ITERAR los datos que se van a mostrar en pantalla !-->

<div class="col-md-3">
<div class="card">
<img class="card-img-top" src="./img/<?php echo $libro['imagen']; ?>" alt=""> <!-- MUESTRA LA IMAGEN DEL LIBRO QUE YA ESTE CARGADO -->
<div class="card-body">
        <h4 class="card-title"><?php echo $libro['nombre']; ?></h4> <!-- ESTO ES EN LA IMAGEN, aparece el nombre de esa imagen o al menos el nombre que le establecimos en un principio a la imagen  !-->
        <a name="" id="" class="btn btn-primary" href="https://www.casadellibro.com/libros-ebooks-gratis/184?srsltid=AfmBOoryPYijFy4fbYmvyYA3yNkd5CsWL0ES6hRHM31yAlUBBaI-bMFw" role="button"> Ver mas libros</a> 
        <!-- ESTE "a" LO QUE HACE ES REDIRECCIONAR AL USUARIO A UNA PAGINA DE LIBROS EN CASO DE QUE LE INTERESE ESE LIBRO -->
</div>    
</div>
</div>

<?php  } ?> <!-- ES EL CIERRE DE LA VARIABLE "foreach" -->


<?php include("template/pie.php"); ?>
