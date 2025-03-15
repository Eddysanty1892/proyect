<?php
include '../php/conexion_be.php'; 

$query = "SELECT * FROM proveedores"; 
$resultado = mysqli_query($conexion, $query);
?>

<script src="../js/editar_proveedor.js"></script>
<script src="../js/eliminar_proveedor.js"></script>

<link rel="stylesheet" href="provedor.css">
<div class="table-container">
    <h2 class="table-title">Lista de Proveedores</h2>
    <table class="custom-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Proveedor</th>
                <th>Descripción</th>
                <th>Correo</th>
                <th>Contacto</th>
                <th>Acciones</th> 
            </tr>
        </thead>
        <tbody>
            
            <?php
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr id='fila-" . $fila['id'] . "'>"; 
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td><img src='../imagenes_provedores/" . $fila['imagen_provedor'] . "' alt='Proveedor' width='50'></td>";
                echo "<td>" . $fila['nombre_provedor'] . "</td>";
                echo "<td>" . $fila['descripcion'] . "</td>";
                echo "<td>" . $fila['correo'] . "</td>";
                echo "<td>" . $fila['contacto'] . "</td>";
                echo "<td class='acciones'>
                    <button class='btn-edit' data-bs-toggle='modal' data-bs-target='#editarProvedorModal' 
                        data-id='" . $fila['id'] . "' 
                        data-nombre='" . $fila['nombre_provedor'] . "' 
                        data-descripcion='" . $fila['descripcion'] . "' 
                        data-correo='" . $fila['correo'] . "' 
                        data-contacto='" . $fila['contacto'] . "' 
                        data-imagen='../imagenes_provedores/" . $fila['imagen_provedor'] . "'>Editar</button>
                    <button class='btn-delete' data-id='" . $fila['id'] . "'>Eliminar</button> <!-- Botón de eliminar -->
                </td>";
                echo "</tr>";
            }
            ?>
            
        </tbody>
    </table>
</div>
<!-- Modal para editar proveedor -->
<div class="modal fade" id="editarProvedorModal" tabindex="-1" aria-labelledby="editarProvedorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarProvedorModalLabel">Editar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarProveedorForm" action="../php/editar_proveedor.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="edit-id" name="id"> 

                    <input type="text" class="form-control mb-4" id="edit-nombre" name="nombre_provedor" placeholder="Nombre del proveedor" required>
                    <input type="text" style="height: 90px;" class="form-control mb-4" id="edit-descripcion" name="descripcion" placeholder="Descripción" required>
                    <input type="email" class="form-control mb-4" id="edit-correo" name="correo" placeholder="Correo" required>
                    <input type="number" class="form-control mb-4" id="edit-contacto" name="contacto" placeholder="Contacto" required>

                    <div class="mb-3">
                        <label class="form-label">Imagen del Proveedor:</label>
                        <input type="file" class="form-control" id="edit-imagen" name="imagen_provedor">
                        <img id="edit-imagen-preview" src="" alt="Imagen actual" width="100" class="mt-2">
                    </div>

                    <button type="submit" class="boton">Guardar Cambios</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </form>
            </div>
        </div>
    </div>
</div>