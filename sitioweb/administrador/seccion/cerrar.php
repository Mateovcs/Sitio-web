<?php
session_start();
session_destroy(); //CERRAR LA SESION INICIADA
header('Location:../index.php'); //SI PULSAN "Cerrar" LOS REDIRECCIONA AL "index.php"
?>