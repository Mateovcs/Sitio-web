<?php
session_start();
session_destroy();
header('Location:../index.php'); //SI PULSAN "Cerrar" LOS REDIRECCIONA AL "index.php"
?>