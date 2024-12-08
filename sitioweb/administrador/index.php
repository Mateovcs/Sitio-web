<?php
session_start(); //SE USA PARA INICIAR SESION O REANUDAR UNA SESION EXISTENTE 
if($_POST){
    if(($_POST['usuario']=="jimena")&&($_POST['contrasenia']=="aysana")){//ESTO ES PARA EL LOGIN DE ADMINISTRADOR, SI O SI TENGO QUE INGRESAR COMO NOMBRE DE USUARIO "jimena" Y CONTRASEÑA "aysana" !-->
        
        $_SESSION['usuario']="ok"; //MARCA QUE EL USUARIO ESTA AUTENTICADO
        $_SESSION['nombreUsuario']="jimena";  //ALMACENA EL NOMBRE DEL USUARIO EN SESION 
        header('Location:inicio.php'); //SI TODO SALIO BIEN, REDIRIGE A LA INTERFAZ DE BIENVENIDA PARA EL ADMINISTRADOR
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
    <title>Administrador de la Biblioteca</title> <!-- titulo de la pestaña de administrador -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/> <!-- ES UN ESTILO DE BOOTSTRAP QUE DESCARGUE PARA EL LOGIN DE ADMINISTRADOR -->

</head>
<body>

    <div class="container">
        <div class="row">

            <div class="col-md-4">


            </div>

                <div class="col-md-4">
</br></br></br>

<!-- TODO LO QUE SE VA A VER DEBAJO DE ESTO ES LA ESTRUCTURA DEL LOGIN PARA EL ADMINISTRADOR -->
                
                    <div class="card">
                    <div class="card-header">
                        Este es el login del Administrador
                    </div>
                    <div class="card-body">

                    <?php if(isset($mensaje)){ ?> <!-- SI el usuario es incorrecto o la contraseña: -->
                        <div class="alert alert-danger" role="alert">
                             <?php echo $mensaje; ?> <!-- APARECE EL TEXTO DE ERROR EN ROJO (por eso ponemos en el class "alert-danger)-->
                        </div>
                    <?php  }  ?>
                        <form method="POST"> <!-- USAMOS EL METODO "POST", ESTO ES PARA ENVIAR LOS DATOS DE MANERA SEGURA EN ESTE CASO ES EL usuario e contraseña --> 

                        <div class= "form-group">
                        <label>Usuario</label>
                        <input type="text" class="form-control" name='usuario' placeholder=""> <!-- Le damos el nombre 'usuario' para llamarlo en la CABECERA DEL TEMPLATE DE ADMINISTRADOR -->
                        </div> 

                        <div class="form-group">
                        <label>Contraseña:</label>
                        <input type="password" class="form-control" name="contrasenia" placeholder="">   <!-- LO MISMO PARA LA CONTRASEÑA -->
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar al administrador</button> <!-- BOTON QUE DICE "Entrar al administrador" !-->
                        </form>

                    </div>

                </div>

        </div>
</body>
</html>