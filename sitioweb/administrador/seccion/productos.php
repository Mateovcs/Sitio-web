<?php include("../template/cabecera.php"); ?>
<?php

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";

$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

echo $txtID. "<br/>";
echo $txtNombre. "<br/>";
echo $txtImagen. "<br/>";
echo $accion. "<br/>";

$host="localhost";
$bd="sitio";
$usuario="root";
$contrasenia="";

try {
       $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia);
       if($conexion)( echo "Conectado a sistema ";) 

} catch ( Exception $ex) {
    
    echo $ex->getMessage();

}


switch($accion){

        case "Agregar":
         
           // INSERT INTO `juegos` (`id`, `nombre`, `imagen`) VALUES (NULL, 'God of War', 'imagen.jpg');
            $sentenciaSQL= $conexion->prepare("INSERT INTO `juegos` (`id`, `nombre`, `imagen`) VALUES (NULL, 'God of War', 'imagen.jpg');");
            $sentenciaSQL->execute();
            
            
            echo "Presionado boton agregar";
            break;

        
        case "Modificar":
            echo "Presionado boton Modificar";
            break;
    
        case "Cancelar":
            echo "Presionado boton Cancelar";
            break;
    
}

?>



<div class="col-md-5">
  
    <div class="card">
        <div class="card-header">
            Datos del juego
        </div>
       
        <div class="card-body">
          
    <form method="POST" enctype="multipart/form-data" >
    
    
    <div class = "form-group">
    <label for="txtID">ID</label>
    <input type="text" class="form-control" name="txtID" id="txtID" placeholder="ID">
    </div>
    
    <div class = "form-group">
    <label for="txtNombre">Nombre</label>
    <input type="text" class="form-control" name="txtNombre" id="txtNombre" placeholder="Nombre del juego">
    </div>

    
    <div class = "form-group">
    <label for="txtNombre">Imagen</label>
    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen">
    </div>
    
    <div class="btn-group" role="group" aria-label="">
        <button type="button" name="accion" value="Agregar"  class="btn btn-succes">Agregar</button>
        <button type="button" name="accion" value="Modificar"class="btn btn-warning">Modificar</button>
        <button type="button" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
    </div>    

</form>
        </div>
        <div class="card-footer text-muted">
            Footer
        </div>
    </div>



</div>
<div class="col-md-7">
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row"></td>
 
                <td>1</td>
                <td>Mateo</td>
                <td>Imagen.jpg</td>
                <td>Seleccionar | Borrar</td>
            </tr>
        
        </tbody>
    </table>
</div>
<?php include("../template/pie.php"); ?>