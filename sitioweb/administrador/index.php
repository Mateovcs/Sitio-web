<?php
session_start();
if($_POST){
    if(($_POST['usuario']=="jimena")&&($_POST['contrasenia']=="aysana")){//ESTO ES PARA EL LOGIN DE ADMINISTRADOR, SI O SI TENGO QUE INGRESAR COMO NOMBRE DE USUARIO "mateo" Y CONTRASEÑA "messi" !-->
        
        $_SESSION['usuario']="ok";
        $_SESSION['nombreUsuario']=="jimena";  
        header('Location:inicio.php');
    }else{
        $mensaje="Error: El usuario o contraseña son incorrectos"; //EN CASO DE QUE NO PONGA NADA EN LOS CAMPOS DE LOGIN DE ADMINISTRADOR ME APARECERA ESE $mensaje

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de la Biblioteca</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>

</head>
<body>

    <div class="container">
        <div class="row">

            <div class="col-md-4">


            </div>

                <div class="col-md-4">
</br></br></br>
                <div class="card">
                    <div class="card-header">
                        Este es el login del Administrador
                    </div>
                    <div class="card-body">

                    <?php if(isset($mensaje)){ ?>
                        <div class="alert alert-danger" role="alert">
                             <?php echo $mensaje; ?>
                        </div>
                    <?php  }  ?>
                        <form method="POST">

                        <div class= "form-group">
                        <label>Usuario</label>
                        <input type="text" class="form-control" name='usuario' placeholder="">
                        </div>

                        <div class="form-group">
                        <label>Contraseña:</label>
                        <input type="password" class="form-control" name="contrasenia" placeholder="">   
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar al administrador</button> <!-- BOTON QUE DICE "Entrar al administrador" !-->
                        </form>

                    </div>

                </div>

        </div>
</body>
</html>