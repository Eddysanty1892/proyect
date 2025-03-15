<?php
include '../php/conexion_be.php';


$nombre_categoria = $_POST['nombre_categoria'];
$tipo = $_POST['tipo'];
$correo = $_POST['correo'];


$check_query = "SELECT id FROM categorias WHERE correo = '$correo'";
$result = mysqli_query($conexion, $check_query);

if (mysqli_num_rows($result) > 0) {
    echo '<script>
        alert("Error: Este correo ya está registrado. Usa otro correo.");
        window.location = "../index/categoria.php";
    </script>';
    exit();
}


if (!isset($_FILES['imagen_categoria']) || $_FILES['imagen_categoria']['error'] != 0) {
    echo '<script>
        alert("Error al subir la imagen");
        window.location = "../index/categoria.php";
    </script>';
    exit();
}

$directorio = "../imagenes_categoria/";  
if (!is_dir($directorio)) {
    mkdir($directorio, 0777, true);  
}

$imagen_nombre = basename($_FILES["imagen_categoria"]["name"]);
$imagen_extension = strtolower(pathinfo($imagen_nombre, PATHINFO_EXTENSION));

$nuevo_nombre = uniqid("categoria_") . '.' . $imagen_extension;
$ruta_final = $directorio . $nuevo_nombre;

$extensiones_permitidas = ["jpg", "jpeg", "png", "gif"];
if (!in_array($imagen_extension, $extensiones_permitidas)) {
    echo '<script>
        alert("Formato de imagen no permitido. Solo JPG, JPEG, PNG y GIF.");
        window.location = "../index/categoria.php";
    </script>';
    exit();
}

if (!move_uploaded_file($_FILES["imagen_categoria"]["tmp_name"], $ruta_final)) {
    echo '<script>
        alert("Error al guardar la imagen en el servidor.");
        window.location = "../index/categoria.php";
    </script>';
    exit();
}

$query = "INSERT INTO categorias (nombre_categoria, tipo, correo, imagen_categoria) 
          VALUES ('$nombre_categoria', '$tipo', '$correo', '$nuevo_nombre')";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '<script>
        alert("Proveedor almacenado exitosamente");
        window.location = "../index/categoria.php";
    </script>';
} else {
    echo "Error en la consulta: " . mysqli_error($conexion);
}
?>
