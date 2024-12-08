<?php include("../template/cabecera.php");?>
<?php

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";  //ES PARA QUE EL ADMINISTRADOR INGRESE EL ID 
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";//ES PARA QUE EL ADMINISTRADOR INGRESE EL NOMBRE
$txtImagen=(isset($_FILES['txtID']['name']))?$_FILES['txtID']['name']:"";//ES PARA QUE EL ADMINISTRADOR INGRESE LA IMAGEN
$accion=(isset($_POST['accion']))?$_POST['accion']:"";//ES PARA QUE EL ADMINISTRADOR INGRESE LA ACCION QUE DESEA REALIZAR

include("../config/bd.php");

switch($accion){  //SWITCH= TE DA UNAS OPCIONES Y EN CASO DE SELECIONAR ALGUNA OPCION TE OFRECE UNA FUNCIONALIDAD DISTINTA, EN ESTE CASO TENES LA OPCION DE AGREGAR, MODIFICAR, ETC

        case"Agregar":
            $sentenciaSQL=$conexion->prepare("INSERT INTO libros (nombre,imagen) VALUES (:nombre,:imagen);"); //Crea una consulta preparada que seria el insert
            $sentenciaSQL->bindParam(':nombre',$txtNombre); //CON EL "bindParam" asociamos las variables "txtNombre" con el parametro ':nombre' que este seria el nombre del archivo
            $sentenciaSQL->bindParam(':imagen',$txtImagen); //CON EL "bindParam" asociamos las variables "txtNombre" con el parametro ':imagen' que este seria la imagen
            $sentenciaSQL->execute();//loS DATOS QUE INGRESAMOS SE INSERTARAN EN LA TABLA "libros"       
            $fecha= new DateTime(); //PARA CREAR UNA MARCA DE TIEMPO, FECHA Y HORA ACTUAL
            $nombreArchivo=($txtImagen != "")?$fecha->geTimestamp()."_".$_FILES["txtImagen"]["name"]:"vieja.jpg"; //ES PARA QUE UNA VEZ INICIEMOS SESION, NOS MUESTRE LOS DATOS QUE HAY
            //PRIMERO VERIFICA SI LA IMAGEN NO ESTA VACIA
            //SEGUNDO: SI SE SUBIO UNA IMAGEN NOS MUESTRA LA MARCA DE TIEMPO Y EL NOMBRE DEL ARCHIVO
            //TERCERO: SI NO SE SUBIO NINGUNA IMAGEN SE USAR EL NOMBRE DE UN ARCHIVO PREDETERMINADO (osea vieja.jpg)

            $tmpImagen=$_FILES["txtImagen"]["tmp_name"]; //ESEL ARCHIVO TEMPORAL QUE SUBIO EL ADMINISTRADOR A TRAVES DE "$_FILES"

            if($tmpImagen!=""){

                    move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo); //EL ARCHIVO QUE ME SUBAN, SE ALMACENARA EN LA CARPETA "img"
            }

            $sentenciaSQL->bindParam(':imagen',$nombreArchivo); //VINCULA EL NOMBRE DEL ARCHO CON EL PARAMETRO ':imagen'
            $sentenciaSQL->execute(); //inserta el registro a nuestra base de datos
            header("Location:productos.php"); // NOS REDIRECCIONA A "productos.php"

            break; //FIN DE TODO EL CODIGO DEL CASE "Agregar"


        case"Modificar":

            $sentenciaSQL=$conexion->prepare("UPDATE libros SET nombre=:nombre WHERE id=:id"); //CONSULTA PARA MODIFICAR DATOS
            $sentenciaSQL->bindParam(':nombre',$txtNombre); //NUEVO NOMBRE DEL LIBRO
            $sentenciaSQL->bindParam(':id',$txtID); // NUEVO ID DEL LIBRO QUE QUEREMOS MODIFICAR 
            $sentenciaSQL->execute(); //ESOS CAMBIOS SE EJECUTAN A NUESTRA BASE DE DATOS

            if ($txtImagen!="") { //VERIFICA SI SE A ENVIADO UNA NUEVA IMAGEN
                $fecha= new DateTime(); //AGREGA UNA NUEVA MARCA DE TIEMPO
                $nombreArchivo=($txtImagen != "")?$fecha->geTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
                //SI EL USUARIO ME INGRESA UNA IMAGEN, SE GUARDA EL TIEMPO ACTUAL, si no se gurada una imagen, se gurda con un nombre predeterminado (imagen,jpg)
                 
                $tmpImagen=$_FILES["txtImagen"]["tmp_name"]; //$tmpImagen es la UBICACION TEMPORAL DEL ARCHIVO 
                move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo); //MUEVE EL ARCHIVO A LA CARPETA "img"
    
                
                $sentenciaSQL=$conexion->prepare("SELECT imagen FROM libros WHERE id=:id"); //REALIZA UNA CONSULTA PARA OBTENER EL NOMBRE DEL ARCHIVO SUBIDO
                $sentenciaSQL->bindParam(':imagen',$txtID);                                 //CON EL ID PROPORCIONADO
                $sentenciaSQL->execute();
                $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY); //El nombre de la imagen estara en $libro["imagen"]
            

            if(isset($libro["imagen"]) &&($libro["imagen"]!="vieja.jpg" )){  //SI EXISTE UNA IMAGEN IGUAL A "vieja.jpg"
                if(file_exists("../../img/".$libro["imagen"])){

                    unlink("../../img/".$libro["imagen"]);                  //SE ELIMINA CON  UNLINK
                }
            }
                        
            $sentenciaSQL=$conexion->prepare("UPDATE libros SET imagen=:imagen WHERE id=:id"); //SE ACTUALIZAN LOS CAMBIOS CON UPDATE
            $sentenciaSQL->bindParam(':imagen',$nombreArchivo); //SE GUARDA EL NUEVO NOMBRE DEL ARCHIVO
            $sentenciaSQL->bindParam(':id',$txtID);             //SE GUARDA SU ID
            $sentenciaSQL->execute();                           //LOS DATOS LO EJECUTA EN LA BASE DE DATOS
            }
            header("Location:productos.php");                   //REDIRECCIONA A productos.php
            
            break;

        case"Cancelar":
             header("Location:productos.php");  //AL PULSAR "Cancelar" NOS REDIRECCIONA A "productos.php"
            break;
        
        case"Seleccionar":
            
            $sentenciaSQL=$conexion->prepare("SELECT * FROM libros WHERE id=:id");  //SELECIONAMOS UN ARCHIVO O CUALQUIER DATO QUE YA ESTE SUBIDO
            $sentenciaSQL->bindParam(':id',$txtID); //TOMAMOS EL ID
            $sentenciaSQL->execute(); //SELECCIONA EL ELEMENTO DE LA BASE DE DATOS
            $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY); //obtenemos los datos de la consulta, de manera que solo lo muestran cuando realmente son utilizados 
            
            $txtNombre=$libro['nombre'];
            $txtImagen=$libro['imagen'];
            //echo "Presionado boton Seleccionar";
                break;
            
        case"Borrar":
            
            $sentenciaSQL=$conexion->prepare("SELECT * FROM libros WHERE id=:id"); //SELECCIONA EL DATO QUE QUEREMOS BORRAR
            $sentenciaSQL->bindParam(':id',$txtID); //TOMA SU ID
            $sentenciaSQL->execute(); 
            $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            
            if(isset($libro["imagen"]) &&($libro["imagen"]!="vieja.jpg" )){
                if(file_exists("../../img/".$libro["imagen"])){

                    unlink("../../img/".$libro["imagen"]);
                }
            } 
            
            $sentenciaSQL=$conexion->prepare("DELETE FROM libros WHERE id=:id"); //BORRA EL DATO
            $sentenciaSQL->bindParam(':id',$txtID); //TENIENDO EN CUENTA SU ID
            $sentenciaSQL->execute();  //LO BORRA DE LA BASE DE DATOS
            header("Location:productos.php");  //NOS REDIRECCIONA A "productos.php"
            break;
}

$sentenciaSQL=$conexion->prepare("SELECT * FROM libros");  //MUESTRA TODOS LOS DATOS QUE YA ESTEN PREESTABLECIDOS
$sentenciaSQL->execute(); //LO EJECUTA DE LA BASE DE DATOS
$listalibros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC); //MUESTRA TODO Y LOS ASOCIA

?>

<div class="col-md-5">
    


<!-- TODO LO QUE VEAS ABAJO DE ESTO, ES LA ESTRUCTURA DEL CUADRO PARA INSERTAR LOS LIBROS, SUS NOMBRES, ID, ETC -->

    <div class="card">
        <div class="card-header">
            Datos del libro
        </div>
        <div class="card-body">
          
    <form method="POST" enctype="multipart/form-data" >
    <div class = "form-group">
    <label for="txtID">ID:</label>
    <input type="text" required  class="form-control" id="txtID" placeholder="ID">
    </div>

    <div class = "form-group">
    <label for="txtNombre">Nombre:</label>
    <input type="text" required class="form-control" value="<?php echo $txtID; ?> "name="txtNombre" id="txtNombre" placeholder="Nombre">
                                            <!-- esto es para que se muestre en pantalla el ID -->
    </div>


    <?php if($txtImagen!=""){ ?>
    
        <img class="img-thumbnail rounded"  src="../../img/ <?php echo $txtImagen;?>" width="50" alt="" srcset="">
                                                    <!-- MUESTRA EN PANTALLA LA IMAGEN -->
    <?php } ?>

    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Nombre ">
    </div>
    
    <div class="btn-group" role="group" aria-label="">
        <!-- TODO ESTO SON LOS BOTONES, PARA AGREGAR, MODIFICAR Y CANCELAR -->
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
        <?php foreach($listalibros as $libro) { ?>
            <tr>
                <td><?php echo $libro['id']; ?></td>
                <td><?php echo $libro['nombre']; ?></td>
                <td>
                    
                <img class="img-thumbnail rounded" src="../../img/<?php echo $libro['imagen']; ?>" width="" alt="" srcset="">
                            
                </td>

                <td>
                <form method="post">
                
                <input type="hidden" name="txtID" id="txtID" value="<?php echo $libro['id']; ?>"/>
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


