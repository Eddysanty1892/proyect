<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['correo'])) {
    // Si no hay sesión activa, redirige al login
    header("Location: ../index/index.php");
    exit();
}

include '../php/conexion_be.php'; // Conexión a la base de datos

// Obtener los datos del usuario desde la base de datos usando el correo guardado en la sesión
$correo = $_SESSION['correo']; // Correo del usuario desde la sesión
$query = "SELECT * FROM registro WHERE correo='$correo'";
$resultado = mysqli_query($conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    // Si la consulta es exitosa y el usuario existe, obtenemos los datos
    $usuario = mysqli_fetch_assoc($resultado); // Almacenamos los datos en $usuario
} else {
    // Si no se encuentra el usuario, redirigimos
    echo '<script>alert("Usuario no encontrado."); window.location.href="../index/index.php";</script>';
    exit();
}
// Verifica si la sesión ya está iniciada antes de llamar a session_start()
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['correo'])) {
    echo '<script>alert("No has iniciado sesión."); window.location.href="../index/index.php";</script>';
    exit();
}

$rol = $_SESSION['rol'];  // Obtén el rol desde la sesión
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index/bienvenida.php">Supermercado</a>

        <!-- Menú Producto -->
        <div class="dropdown">
            <a class="navbar-brand dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Producto
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../index/no_alcance.html">Ver Producto</a></li>
                <?php if ($rol === 'Administrador' || $rol === 'Vendedor'): ?>
                    <li><a class="dropdown-item" href="#">Crear Producto</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Menú Categoría -->
        <div class="dropdown">
            <a class="navbar-brand dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Categoría
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../index/categoria.php">Ver Categorías</a></li>
                <?php if ($rol === 'Administrador' || $rol === 'Vendedor'): ?>
                    <li><a class="dropdown-item" href="#">Crear Categoría</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Menú Proveedor -->
        <div class="dropdown">
            <a class="navbar-brand dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Proveedor
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../index/provedor.php">Ver Proveedores</a></li>
                <?php if ($rol === 'Administrador' || $rol === 'Vendedor'): ?>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#crearProvedorModal">Crear Proveedor</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#perfilModal">Ver Perfil</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal para crear proveedor -->
<div class="modal fade" id="crearProvedorModal" tabindex="-1" aria-labelledby="crearProvedorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearProvedorModalLabel">Crear Proveedor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="../php/provedor_base.php" method="POST" enctype="multipart/form-data">
            <div class="modal-footer">
              <input type="text" class="form-control mb-4" name="nombre_provedor" placeholder="Nombre del proveedor" required>
              <input type="text" style="height: 90px;" class="form-control mb-4" name="descripcion" placeholder="Descripción" required>
              <input type="email" class="form-control mb-4" name="correo" placeholder="Correo" required>
              <input type="number" class="form-control mb-4" name="contacto" placeholder="Contacto" required>

              <div class="mb-3">
                <label class="form-label">Imagen del Proveedor:</label>
                <input type="file" class="form-control" name="imagen_Provedor" required>
              </div>
              
              <button type="submit" class="boton">Guardar</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
<!-- Modal para crear categoria -->
<div class="modal fade" id="crearCategoriaModal" tabindex="-1" aria-labelledby="crearCategoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearCategoriaModalLabel">Crear Proveedor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="../php/categoria_base.php" method="POST" enctype="multipart/form-data">
            <div class="modal-footer">
              <input type="text" class="form-control mb-4" name="nombre_categoria" placeholder="Nombre de categoria" required>
              <input type="text" style="height: 90px;" class="form-control mb-4" name="tipo" placeholder="tipo" required>
              <input type="email" class="form-control mb-4" name="correo" placeholder="Correo" required>
              
              <div class="mb-3">
                <label class="form-label">Imagen de categoria:</label>
                <input type="file" class="form-control" name="imagen_categoria" required>
              </div>
              
              <button type="submit" class="boton">Guardar</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
