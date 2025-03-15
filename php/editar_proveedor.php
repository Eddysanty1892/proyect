<?php
include 'conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre_provedor'];
    $descripcion = $_POST['descripcion'];
    $correo = $_POST['correo'];
    $contacto = $_POST['contacto'];

    
    if (!empty($_FILES['imagen_provedor']['name'])) {
        $imagen = $_FILES['imagen_provedor']['name'];
        $ruta = "../imagenes_provedores/" . $imagen;
        move_uploaded_file($_FILES['imagen_provedor']['tmp_name'], $ruta);
        $query = "UPDATE proveedores SET nombre_provedor='$nombre', descripcion='$descripcion', correo='$correo', contacto='$contacto', imagen_provedor='$imagen' WHERE id=$id";
    } else {
        $query = "UPDATE proveedores SET nombre_provedor='$nombre', descripcion='$descripcion', correo='$correo', contacto='$contacto' WHERE id=$id";
    }

    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        echo "<script>alert('Proveedor actualizado con éxito'); window.location.href='../index/provedor.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar proveedor'); window.history.back();</script>";
    }
}
?>
