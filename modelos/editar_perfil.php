<?php
session_start();
include '../config/conexion_be.php'; 

if (!isset($_SESSION['correo'])) {
    echo '<script>alert("Error: No has iniciado sesión."); window.location.href="../index/index.php";</script>';
    exit();
}

$correo = $_SESSION['correo'];
$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$numero = $_POST['numero'];

$query = "UPDATE registro SET usuario='$usuario', nombre='$nombre', numero='$numero' WHERE correo='$correo'";
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
    echo '<script>alert("Perfil actualizado correctamente."); window.location.href="../vista/bienvenida.php";</script>';
} else {
    echo '<script>alert("Error al actualizar el perfil."); window.location.href="../vista/bienvenida.php";</script>';
}

mysqli_close($conexion);
?>
