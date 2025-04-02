<?php
include '../config/conexion_be.php'; 

$query = "SELECT * FROM categorias"; 
$resultado = mysqli_query($conexion, $query);
?>

<script src="../js/editar_categoria.js"></script>
<script src="../js/eliminar_categoria.js"></script> 
<link rel="stylesheet" href="../publico/css/categoria.css">
<div class="table-container">
    <h2 class="table-title">Lista de Ctegorias</h2>
    <table class="custom-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Correo</th>
                <th>Acciones</th> 
            </tr>
        </thead>
        <tbody>
            <?php
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr id='fila-" . $fila['id'] . "'>"; 
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td><img src='../imagenes_categoria/" . $fila['imagen_categoria'] . "' alt='Proveedor' width='50'></td>";
                echo "<td>" . $fila['nombre_categoria'] . "</td>";
                echo "<td>" . $fila['tipo'] . "</td>";
                echo "<td>" . $fila['correo'] . "</td>";
                echo "<td class='acciones'>";

                if ($rol === 'Comprador') {
                    // Si el usuario es Comprador, solo mostrar el botón "Comparar"
                    echo "<button class='btn-compare'>Comparar</button>";
                } else {
                    // Si el usuario es Administrador o Vendedor, mostrar Editar y Eliminar
                    echo "<button class='btn-edit' data-bs-toggle='modal' data-bs-target='#editarCategoriaModal' 
                        data-id='" . $fila['id'] . "' 
                        data-nombre='" . $fila['nombre_categoria'] . "' 
                        data-descripcion='" . $fila['tipo'] . "' 
                        data-correo='" . $fila['correo'] . "' 
                        data-imagen='../imagenes_categoria/" . $fila['imagen_categoria'] . "'>Editar</button>";

                    echo "<button class='btn-delete' data-id='" . $fila['id'] . "'>Eliminar</button>"; 
                }

                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal para editar categoria -->
<div class="modal fade" id="editarCategoriaModal" tabindex="-1" aria-labelledby="editarCategoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarCategoriaModalLabel">Editar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarCategoriaForm" action="../modelos/editar_categoria.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="edit-id" name="id"> 

                    <input type="text" class="form-control mb-4" id="edit-nombre" name="nombre_categoria" placeholder="Nombre del categoria" required>
                    <input type="text" style="height: 90px;" class="form-control mb-4" id="edit-descripcion" name="tipo" placeholder="Tipo" required>
                    <input type="email" class="form-control mb-4" id="edit-correo" name="correo" placeholder="Correo" required>
                    

                    <div class="mb-3">
                        <label class="form-label">Imagen del Proveedor:</label>
                        <input type="file" class="form-control" id="edit-imagen" name="imagen_categoria">
                        <img id="edit-imagen-preview" src="" alt="Imagen actual" width="100" class="mt-2">
                    </div>

                    <button type="submit" class="boton">Guardar Cambios</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </form>
            </div>
        </div>
    </div>
</div>