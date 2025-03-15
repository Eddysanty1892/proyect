<?php
include '../php/conexion_be.php';


$nombre_producto = $_POST['nombre_producto'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];


if (!isset($_FILES['imagen_Producto']) || $_FILES['imagen_Producto']['error'] != 0) {
    echo '<script>
        alert("Error al subir la imagen");
        window.location = "../bienvenida.php";
    </script>';
    exit();
}


$directorio = "../imagenes/";  
if (!is_dir($directorio)) {
    mkdir($directorio, 0777, true);  
}


$imagen_nombre = basename($_FILES["imagen_Producto"]["name"]);
$imagen_temp = $_FILES["imagen_Producto"]["tmp_name"];
$imagen_extension = strtolower(pathinfo($imagen_nombre, PATHINFO_EXTENSION));


$nuevo_nombre = uniqid("producto_") . '.' . $imagen_extension;
$ruta_final = $directorio . $nuevo_nombre;


$extensiones_permitidas = ["jpg", "jpeg", "png", "gif"];
if (!in_array($imagen_extension, $extensiones_permitidas)) {
    echo '<script>
        alert("Formato de imagen no permitido. Solo JPG, JPEG, PNG y GIF.");
        window.location = "../bienvenida.php";
    </script>';
    exit();
}


if (!move_uploaded_file($imagen_temp, $ruta_final)) {
    echo '<script>
        alert("Error al guardar la imagen en el servidor.");
        window.location = "../bienvenida.php";
    </script>';
    exit();
}

$query = "INSERT INTO producto (nombre_producto, descripcion, precio, cantidad, imagen_Producto) 
          VALUES ('$nombre_producto', '$descripcion', '$precio', '$cantidad', '$nuevo_nombre')";

$ejecutar = mysqli_query($conexion, $query);


if ($ejecutar) {
    echo '<script>
        alert("Producto almacenado exitosamente");
        window.location = "../bienvenida.php";
    </script>';
} else {
    echo '<script>
        alert("Error al guardar el producto en la base de datos");
    </script>';
}

?>
