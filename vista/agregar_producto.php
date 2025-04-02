<?php
include '../config/conexion_be.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rol = $_SESSION['rol'] ?? 'Invitado'; 

$query = "SELECT * FROM productos";
$resultado = mysqli_query($conexion, $query);
?>

<script src="../js/editar_producto.js"></script>
<script src="../js/eliminar_producto.js"></script> 
<link rel="stylesheet" href="producto.css">
<div class="table-container">
    <h2 class="table-title">Lista de Productos</h2>
    <table class="custom-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acciones</th> 
            </tr>
        </thead>
        <tbody>
        <?php
while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "<tr id='fila-" . $fila['id'] . "'>"; 
    echo "<td>" . $fila['id'] . "</td>";
    echo "<td><img src='../imagenes_productos/" . $fila['imagen'] . "' alt='Producto' width='50'></td>";
    echo "<td>" . htmlspecialchars($fila['nombre_producto']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['descripcion']) . "</td>";
    echo "<td>" . $fila['precio'] . "</td>";
    echo "<td class='acciones'>";

    if ($rol === 'Comprador') {
        echo "<button class='btn-compare'>Comparar</button>";
    } else {
       
        echo "<button class='btn-edit' 
    data-bs-toggle='modal' data-bs-target='#editarProductoModal' 
    data-id='" . htmlspecialchars($fila['id']) . "' 
    data-nombre='" . htmlspecialchars($fila['nombre_producto']) . "' 
    data-descripcion='" . htmlspecialchars($fila['descripcion']) . "' 
    data-precio='" . $fila['precio'] . "' 
    data-imagen='../imagenes_productos/" . $fila['imagen'] . "'>
    Editar
</button>";
;
        
echo "<button class='btn-delete' data-id='" . $fila['id'] . "'>Eliminar</button>";

    }

    echo "</td>";
    echo "</tr>";
}
?>
        </tbody>
    </table>
</div>

<!-- Modal para editar producto -->
<div class="modal fade" id="editarProductoModal" tabindex="-1" aria-labelledby="editarProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarProductoModalLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="editarProductoForm" action="../php/editar_producto.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="edit-id" name="id">


    <input type="text" class="form-control mb-4" id="edit-nombre" name="nombre_producto" placeholder="Nombre del producto" required>
    <textarea class="form-control mb-4" id="edit-descripcion" name="descripcion" placeholder="Descripción" required></textarea>
    <input type="number" class="form-control mb-4" id="edit-precio" name="precio" placeholder="Precio" required>

    <div class="mb-3">
        <label class="form-label">Imagen del Producto:</label>
        <input type="file" class="form-control" id="edit-imagen" name="imagen">
        <img id="edit-imagen-preview" src="" alt="Imagen actual" width="100" class="mt-2 d-none">
    </div>

    <button type="submit" class="btn btn-success">Guardar Cambios</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
</form>


            </div>
        </div>
    </div>
</div>
