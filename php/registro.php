<?php

include '../php/conexion_be.php';

$documento = $_POST['documento'];
$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$numero = $_POST['numero'];
$contraseña = $_POST['contraseña'];
$rol = $_POST['rol']; 


$contraseña = hash('sha512', $contraseña); 

$query = "INSERT INTO registro(documento, nombre, usuario, correo, numero, contraseña,rol) 
          VALUES('$documento','$nombre','$usuario','$correo','$numero','$contraseña','$rol')";



$ejecutar = mysqli_query($conexion,$query);

if ($ejecutar) {
    echo '
    <script>
    alert("Usuario almacenado exitosamente");
    window.location = "../index/index.php"; // <-- Aquí está corregido
    </script>
    ';
} else {
    echo '
    <script>
    alert("Inténtalo de nuevo, usuario no almacenado");
    window.location = "../index/index.php"; // <-- Aquí está corregido
    </script>
    ';
}


mysqli_close($conexion);
?>