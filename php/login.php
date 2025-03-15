<?php
session_start(); 

include '../php/conexion_be.php'; 

$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

$contraseña = hash('sha512', $contraseña); 

$validar_login = mysqli_query($conexion, "SELECT * FROM registro WHERE correo='$correo' AND contraseña='$contraseña'");

if(mysqli_num_rows($validar_login) > 0){
    $_SESSION['correo'] = $correo;  
    header("Location: ../index/bienvenida.php");
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
