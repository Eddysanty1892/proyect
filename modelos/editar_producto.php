<?php
/*
include 'conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    
  
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        die("<script>alert('Error: ID del producto no recibido correctamente.'); window.history.back();</script>");
    }

    $id = intval($_POST['id']); 
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre_producto']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $precio = floatval($_POST['precio']);

    $query = "UPDATE productos SET 
        nombre_producto='$nombre', 
        descripcion='$descripcion', 
        precio='$precio' 
        WHERE id=$id";

    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        echo "<script>alert('Producto actualizado con éxito'); window.location.href='../index/producto.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el producto'); window.history.back();</script>";
    }
}
?>
