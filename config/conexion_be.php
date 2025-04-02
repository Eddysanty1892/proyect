<?php
$conexion = mysqli_connect("localhost", "root", "", "login_regitro");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
