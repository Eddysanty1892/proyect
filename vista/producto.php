<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías - Supermercado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../publico/css/productos.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include '../vista/navbar.php'; ?>

<!-- Modal de Perfil -->
<div class="modal fade" id="perfilModal" tabindex="-1" aria-labelledby="perfilModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="perfilModalLabel">Mi Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="perfilForm" action="../modelos/editar_perfil.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label"><b>Documento:</b></label>
                        <input type="text" class="form-control" value="<?= $usuario['documento'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Correo:</b></label>
                        <input type="email" class="form-control" value="<?= $usuario['correo'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Usuario:</b></label>
                        <input type="text" class="form-control editable" name="usuario" value="<?= $usuario['usuario'] ?>" disabled required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Nombre:</b></label>
                        <input type="text" class="form-control editable" name="nombre" value="<?= $usuario['nombre'] ?>" disabled required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Número:</b></label>
                        <input type="text" class="form-control editable" name="numero" value="<?= $usuario['numero'] ?>" disabled required>
                    </div>
                    <button type="button" id="editarBtn" class="btn btn-warning">Editar</button>
                    <button type="submit" id="guardarBtn" class="btn btn-success d-none">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../vista/agregar_producto.php'; ?>
<?php include '../vista/footer.php'; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById('editarBtn').addEventListener('click', function() {
        let campos = document.querySelectorAll('.editable');
        campos.forEach(campo => campo.removeAttribute('disabled'));
        document.getElementById('guardarBtn').classList.remove('d-none');
        this.classList.add('d-none');
    });
</script>

<script>
    document.getElementById('editarBtn').addEventListener('click', function() {
        let campos = document.querySelectorAll('.editable');
        campos.forEach(campo => campo.removeAttribute('disabled')); 
        document.getElementById('guardarBtn').classList.remove('d-none'); 
        this.classList.add('d-none');
    });
</script>
</body>
</html>
