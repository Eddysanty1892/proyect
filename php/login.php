<?php
session_start();
include '../php/conexion_be.php'; 

$correo = $_POST['correo'];
$contraseña = hash('sha512', $_POST['contraseña']); // Asegúrate de hacer hash de la contraseña para compararla con la base de datos

$validar_login = mysqli_query($conexion, "SELECT * FROM registro WHERE correo='$correo' AND contraseña='$contraseña'");

if(mysqli_num_rows($validar_login) > 0){
    $usuario = mysqli_fetch_assoc($validar_login);

    $_SESSION['correo'] = $usuario['correo'];  // Guardamos el correo del usuario en la sesión
    $_SESSION['rol'] = $usuario['rol'];  // Guardamos el rol del usuario en la sesión
    
    // Redirigir según el rol
    if ($usuario['rol'] === 'Administrador') {
        header("Location: ../index/bienvenida.php");  // Redirige a la página para administradores
    } elseif ($usuario['rol'] === 'Vendedor') {
        header("Location: ../index/bienvenida.php");  // Redirige a la página para vendedores
    } else {
        header("Location: ../index/bienvenida.php");  // Redirige a la página para compradores
    }
    exit();
} else {
    echo '
    <script>
    alert("Usuario no existe, verifique los datos");
    window.location = "../index/index.php";
    </script>
    ';
    exit();
}
?>
