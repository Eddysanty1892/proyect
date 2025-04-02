<?php
include '../config/conexion_be.php';


$nombre_provedor = $_POST['nombre_provedor'];
$descripcion = $_POST['descripcion'];
$correo = $_POST['correo'];
$contacto = $_POST['contacto'];

$check_query = "SELECT id FROM proveedores WHERE correo = '$correo'";
$result = mysqli_query($conexion, $check_query);

if (mysqli_num_rows($result) > 0) {
    echo '<script>
        alert("Error: Este correo ya está registrado. Usa otro correo.");
        window.location = "../index/provedor.php";
    </script>';
    exit();
}


if (!isset($_FILES['imagen_Provedor']) || $_FILES['imagen_Provedor']['error'] != 0) {
    echo '<script>
        alert("Error al subir la imagen");
        window.location = "../vista/bienvenida.php";
    </script>';
    exit();
}

$directorio = "../publico/imagenes_provedores/";  
if (!is_dir($directorio)) {
    mkdir($directorio, 0777, true);  
}

$imagen_nombre = basename($_FILES["imagen_Provedor"]["name"]);
$imagen_extension = strtolower(pathinfo($imagen_nombre, PATHINFO_EXTENSION));

$nuevo_nombre = uniqid("provedor_") . '.' . $imagen_extension;
$ruta_final = $directorio . $nuevo_nombre;

$extensiones_permitidas = ["jpg", "jpeg", "png", "gif"];
if (!in_array($imagen_extension, $extensiones_permitidas)) {
    echo '<script>
        alert("Formato de imagen no permitido. Solo JPG, JPEG, PNG y GIF.");
        window.location = "../vista/provedor.php";
    </script>';
    exit();
}

if (!move_uploaded_file($_FILES["imagen_Provedor"]["tmp_name"], $ruta_final)) {
    echo '<script>
        alert("Error al guardar la imagen en el servidor.");
        window.location = "../vista/provedor.php";
    </script>';
    exit();
}


$query = "INSERT INTO proveedores (nombre_provedor, descripcion, correo, contacto, imagen_provedor) 
          VALUES ('$nombre_provedor', '$descripcion', '$correo', '$contacto', '$nuevo_nombre')";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '<script>
        alert("Proveedor almacenado exitosamente");
        window.location = "../vista/provedor.php";
    </script>';
} else {
    echo "Error en la consulta: " . mysqli_error($conexion);
}
?>
