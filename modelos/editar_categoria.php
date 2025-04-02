<?php
include '../config/conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre_categ = $_POST['nombre_categoria'];
    $tipo = $_POST['tipo'];
    $correo = $_POST['correo'];

    if (!empty($_FILES['imagen_categoria']['name'])) {
        $imagen = $_FILES['imagen_categoria']['name'];
        $ruta = "../publico/imagenes_categoria/" . $imagen;
        move_uploaded_file($_FILES['imagen_categoria']['tmp_name'], $ruta);
       
        $query = "UPDATE categorias SET nombre_categoria='$nombre_categ', tipo='$tipo', correo='$correo', imagen_categoria='$imagen' WHERE id=$id";
    } else {
        
        $query = "UPDATE categorias SET nombre_categoria='$nombre_categ', tipo='$tipo', correo='$correo' WHERE id=$id";
    }

    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        echo "<script>alert('Categoría actualizada con éxito'); window.location.href='../vista/categoria.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar categoría'); window.history.back();</script>";
    }
}
?>
