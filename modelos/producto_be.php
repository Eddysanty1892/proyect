<?php
include '../config/conexion_be.php'; // Corrección de "nclude"

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación de datos
    if (
        isset($_POST["nombre_producto"]) &&
        isset($_POST["descripcion"]) &&
        isset($_POST["precio"]) &&
        isset($_FILES["imagen"])
    ) {
        // Recibir datos del formulario
        $nombre_producto = mysqli_real_escape_string($conexion, $_POST['nombre_producto']);
        $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
        $precio = mysqli_real_escape_string($conexion, $_POST['precio']);

        // Verificar si la imagen fue subida correctamente
        if ($_FILES['imagen']['error'] !== 0) {
            echo '<script>
                alert("Error al subir la imagen.");
                window.location = "../vista/producto.php";
            </script>';
            exit();
        }

        // Carpeta donde se guardarán las imágenes
        $directorio = "../publico/imagenes_productos/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        // Procesar la imagen
        $imagen_nombre = basename($_FILES["imagen"]["name"]);
        $imagen_extension = strtolower(pathinfo($imagen_nombre, PATHINFO_EXTENSION));
        $nuevo_nombre = uniqid("producto_") . '.' . $imagen_extension;
        $ruta_final = $directorio . $nuevo_nombre;

        // Validar formato de imagen
        $extensiones_permitidas = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imagen_extension, $extensiones_permitidas)) {
            echo '<script>
                alert("Formato de imagen no permitido. Solo JPG, JPEG, PNG y GIF.");
                window.location = "../vista/producto.php";
            </script>';
            exit();
        }

        // Guardar la imagen en el servidor
        if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_final)) {
            echo '<script>
                alert("Error al guardar la imagen en el servidor.");
                window.location = "../vista/producto.php";
            </script>';
            exit();
        }

        // Insertar datos en la base de datos
        $query = "INSERT INTO productos (nombre_producto, descripcion, precio, imagen) 
                  VALUES ('$nombre_producto', '$descripcion', '$precio', '$nuevo_nombre')";

        if (mysqli_query($conexion, $query)) {
            echo '<script>
                alert("Producto almacenado exitosamente");
                window.location = "../vista/producto.php";
            </script>';
        } else {
            echo "Error en la consulta: " . mysqli_error($conexion);
        }
    } else {
        echo '<script>
            alert("Todos los campos son obligatorios.");
            window.location = "../vista/producto.php";
        </script>';
    }
} else {
    echo '<script>
        alert("Acceso no permitido.");
        window.location = "../vista/producto.php";
    </script>';
}
?>


