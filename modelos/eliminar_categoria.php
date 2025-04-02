<?php
include '../config/conexion_be.php'; 

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM categorias WHERE id = $id";
    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
