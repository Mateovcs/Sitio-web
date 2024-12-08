<!-- ESTE ES EL PRINCIPIO DE LA PAGINA, SE ENCUENTRA EN "localhost/sitioweb/" !-->

<?php include("template/cabecera.php"); ?>

        <div class="jumbotron text-center">
            <h1 class="display-3">Bienvenido a esta Biblioteca Virtual</h1> <!-- INICIO DE LA PAGINA, OSEA LA BIENVENIDA PARA TODO PUBLICO, NO ADMINISTRADOR !-->
            <p class="lead">Consulta los libros que dispone esta Biblioteca</p>
            <hr class="my-2">
        <img width="400" src="img/vieja.jpg" class="img-thumbnail rounded mx-auto d-block" /> <!--FOTO DE LA VIEJITA, SI LO QUERES CAMBIAR MODIFICA EL SRC !-->

            <p>Más Información debajo de esto</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="productos.php" role="button">Ver estanteria de libros</a> <!-- ESTE ES EL BOTON "Ver estanteria de libros" !-->
            </p>
        </div>

<?php include("template/pie.php"); ?>

<!-- EN TODOS LOS ARCHIVOS VAN A VER CABECERA Y PIE, ESO ES POR QUE NOSOTROS HACEMOS EL CUERPO DE LA PAGINA Y POR NORMA SE NECESITA UNA CABECERA Y UN PIE !-->
 
<!-- EN ESTE CASO, EL TEMPLATE VAN A SER LAS OPCIONES DE "Modo administrador" "Inicio" "Libros" "Nosotros" !-->
