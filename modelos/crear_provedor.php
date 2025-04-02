<?php
include '../config/conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $nombre_proveedor = trim($_POST['nombre_proveedor'] ?? '');
    $contacto = trim($_POST['contacto'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $email = trim($_POST['email'] ?? '');

   
    if (empty($nombre_proveedor) || empty($contacto) || empty($telefono) || empty($email)) {
        die('<script>
            alert("Todos los campos son obligatorios");
            window.location = "../vista/bienvenida.php";
        </script>');
    }

  
    $query = "INSERT INTO proveedores (nombre_proveedor, contacto, telefono, email) 
              VALUES ('$nombre_proveedor', '$contacto', '$telefono', '$email')";

    $ejecutar = mysqli_query($conexion, $query);

    if ($ejecutar) {
        echo '<script>
            alert("Proveedor registrado exitosamente");
            window.location = "../vista/bienvenida.php";
        </script>';
    } else {
        echo '<script>
            alert("Error al registrar el proveedor en la base de datos");
        </script>';
    }
} else {
    echo "No se recibió una solicitud POST.";
}
?>
