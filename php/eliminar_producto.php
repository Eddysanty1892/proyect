
<?php
/*
include 'conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']); 
  
    $queryCheck = "SELECT * FROM productos WHERE id = $id";
    $resultadoCheck = mysqli_query($conexion, $queryCheck);

    if (mysqli_num_rows($resultadoCheck) > 0) {
        $query = "DELETE FROM productos WHERE id = $id";
        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            echo "Producto eliminado con éxito.";
        } else {
            echo "Error al eliminar el producto.";
        }
    } else {
        echo "Error: Producto no encontrado.";
    }
} else {
    echo "Error: ID del producto no recibido.";
}
*/
?>
