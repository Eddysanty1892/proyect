<?php
include '../php/conexion_be.php';

$documento = $_POST['documento'];
$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$numero = $_POST['numero'];
$contraseña = $_POST['contraseña'];
$rol = $_POST['rol']; // Obtén el rol del formulario

// Encriptar la contraseña
$contraseña = hash('sha512', $contraseña);

// Inserción en la base de datos
$query = "INSERT INTO registro(documento, nombre, usuario, correo, numero, contraseña, rol) 
          VALUES('$documento', '$nombre', '$usuario', '$correo', '$numero', '$contraseña', '$rol')";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    // Después de insertar al usuario, obtenemos el ID del último usuario insertado
    $last_id = mysqli_insert_id($conexion); // Obtener el ID del último usuario insertado

    // Obtener los datos del usuario recién insertado
    $query_user = "SELECT * FROM registro WHERE id='$last_id'";
    $result_user = mysqli_query($conexion, $query_user);
    $usuario = mysqli_fetch_assoc($result_user);

    // Guardar los datos del usuario en la sesión
    session_start();
    $_SESSION['correo'] = $usuario['correo'];  // Guardamos el correo del usuario en la sesión
    $_SESSION['rol'] = $usuario['rol'];  // Guardamos el rol del usuario en la sesión

    // Mostramos una alerta de éxito y redirigimos al login (index.php)
    echo '
    <script>
        alert("Usuario registrado exitosamente");
        window.location = "../index/index.php";
    </script>
    ';
    exit();
} else {
    echo '
    <script>
        alert("Inténtalo de nuevo, usuario no registrado");
        window.location = "../index/index.php";
    </script>
    ';
}

mysqli_close($conexion);
?>
