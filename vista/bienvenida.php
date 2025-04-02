<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['correo'])) {
    header("Location: ../vista/index.php");  // Redirigir al login si no está autenticado
    exit();
}

$rol = $_SESSION['rol'];

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../publico/css/bienvenid.css">
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
                        <input type="text" class="form-control" value="<?= isset($usuario['documento']) ? $usuario['documento'] : ''; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Correo:</b></label>
                        <input type="email" class="form-control" value="<?= isset($usuario['correo']) ? $usuario['correo'] : ''; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Usuario:</b></label>
                        <input type="text" class="form-control editable" name="usuario" value="<?= isset($usuario['usuario']) ? $usuario['usuario'] : ''; ?>" disabled required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Nombre:</b></label>
                        <input type="text" class="form-control editable" name="nombre" value="<?= isset($usuario['nombre']) ? $usuario['nombre'] : ''; ?>" disabled required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Número:</b></label>
                        <input type="text" class="form-control editable" name="numero" value="<?= isset($usuario['numero']) ? $usuario['numero'] : ''; ?>" disabled required>
                    </div>
                    <button type="button" id="editarBtn" class="btn btn-warning">Editar</button>
                    <button type="submit" id="guardarBtn" class="btn btn-success d-none">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>




<div class="mision-vision">
    <div class="card">
        <img src="https://financialfood.es/wp-content/uploads/2019/11/Compras-en-supermercado.jpg" alt="Misión del Supermercado" class="supermarket-img">
        <h3>Nuestra Misión</h3>
        <p>Brindar productos de alta calidad a precios accesibles, garantizando una experiencia de compra eficiente y agradable.</p>
    </div>
    <div class="card">
        <img src="https://images.ecestaticos.com/a-vJiB2t-_kpCj855zuQ5ASRZIg=/0x88:1697x1042/1338x751/filters:fill(white):format(jpg)/f.elconfidencial.com%2Foriginal%2F44f%2F433%2F5e8%2F44f4335e86d0b12d7f52266c92c82ac9.jpg" alt="Visión del Supermercado" class="supermarket-img">
        <h3>Nuestra Visión</h3>
        <p>Ser el supermercado líder, reconocido por su calidad, atención al cliente y compromiso con la sostenibilidad.</p>
    </div>
</div>

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

</body>
</html>
