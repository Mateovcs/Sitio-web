<?php include("../template/cabecera.php");?>
<?php

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";  //ES PARA QUE EL USUARIO INGRESE EL ID 
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";//ES PARA QUE EL USUARIO INGRESE EL NOMBRE
$txtImagen=(isset($_FILES['txtID']['name']))?$_FILES['txtID']['name']:"";//ES PARA QUE EL USUARIO INGRESE LA IMAGEN
$accion=(isset($_POST['accion']))?$_POST['accion']:"";//ES PARA QUE EL USUARIO INGRESE LA ACCION QUE DESEA REALIZAR

include("../config/bd.php");

switch($accion){
        case"Agregar":
            $sentenciaSQL=$conexion->prepare("INSERT INTO juegos (nombre,imagen) VALUES (:nombre,:imagen);");
            $sentenciaSQL->bindParam(':nombre',$txtNombre);
            $sentenciaSQL->bindParam(':imagen',$txtImagen);
            $sentenciaSQL->execute();            
            $fecha= new DateTime();
            $nombreArchivo=($txtImagen != "")?$fecha->geTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg"; //ES PARA QUE UNA VEZ INICIEMOS SESION, NOS MUESTRE LOS DATOS QUE HAY
            
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

            if($tmpImagen!=""){

                    move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
            }

            $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
            $sentenciaSQL->execute();
            header("Location:productos.php");
            break;

        case"Modificar":

            $sentenciaSQL=$conexion->prepare("UPDATE juegos SET nombre=:nombre WHERE id=:id");
            $sentenciaSQL->bindParam(':nombre',$txtNombre);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();

            if ($txtImagen!="") {
                $fecha= new DateTime();
                $nombreArchivo=($txtImagen != "")?$fecha->geTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";

                 
                $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
                move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
    
                
                $sentenciaSQL=$conexion->prepare("SELECT imagen FROM juegos WHERE id=:id");
                $sentenciaSQL->bindParam(':imagen',$txtID);
                $sentenciaSQL->execute();
                $juego=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            

            if(isset($juego["imagen"]) &&($juego["imagen"]!="imagen.jpg" )){
                if(file_exists("../../img/".$juego["imagen"])){

                    unlink("../../img/".$juego["imagen"]);
                }
            }
                        
            $sentenciaSQL=$conexion->prepare("UPDATE juegos SET imagen=:imagen WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            }
            header("Location:productos.php");
            
            break;

        case"Cancelar":
             header("Location:productos.php");
            break;
        
        case"Seleccionar":
            
            $sentenciaSQL=$conexion->prepare("SELECT * FROM juegos WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $juego=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            
            $txtNombre=$juego['nombre'];
            $txtImagen=$juego['imagen'];
            //echo "Presionado boton Seleccionar";
                break;
            
        case"Borrar":
            
            $sentenciaSQL=$conexion->prepare("SELECT * FROM juegos WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $juego=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            
            if(isset($juego["imagen"]) &&($juego["imagen"]!="imagen.jpg" )){
                if(file_exists("../../img/".$juego["imagen"])){

                    unlink("../../img/".$juego["imagen"]);
                }
            } 
            
            $sentenciaSQL=$conexion->prepare("DELETE FROM juegos WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            header("Location:productos.php");
            break;
}

$sentenciaSQL=$conexion->prepare("SELECT * FROM juegos");
$sentenciaSQL->execute();
$listaJuegos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-5">
    
    <div class="card">
        <div class="card-header">
            Datos del juego
        </div>
        <div class="card-body">
          
    <form method="POST" enctype="multipart/form-data" >
    <div class = "form-group">
    <label for="txtID">ID:</label>
    <input type="text" required  class="form-control" id="txtID" placeholder="ID">
    </div>

    <div class = "form-group">
    <label for="txtNombre">Nombre:</label>
    <input type="text" required class="form-control" value="<?php echo $txtID; ?> name="txtNombre" id="txtNombre" placeholder="Nombre">
    </div>


    <?php if($txtImagen!=""){ ?>
    
        <img class="img-thumbnail rounded"  src="../../img/ <?php echo $txtImagen;?>" width="50" alt="" srcset="">
    
    <?php } ?>

    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Nombre ">
    </div>
    
    <div class="btn-group" role="group" aria-label="">
        <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
        <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
        <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
    </div>

    </form>
    
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
        <?php foreach($listaJuegos as $juego) { ?>
            <tr>
                <td><?php echo $juego['id']; ?></td>
                <td><?php echo $juego['nombre']; ?></td>
                <td>
                    
                <img class="img-thumbnail rounded" src="../../img/<?php echo $juego['imagen']; ?>" width="" alt="" srcset="">
                            
                </td>

                <td>
                <form method="post">
                
                <input type="hidden" name="txtID" id="txtID" value="<?php echo $juego['id']; ?>"/>
                <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>

                </form>
                </td>
            </tr>
        <?php  }  ?>
        </tbody>
    </table>

</div>

<?php include("../template/pie.php");?>


