<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['correo'])) {
    // Si no hay sesión activa, redirige al login
    header("Location: ../vista/index.php");
    exit();
}

include '../config/conexion_be.php'; // Conexión a la base de datos

// Obtener los datos del usuario desde la base de datos usando el correo guardado en la sesión
$correo = $_SESSION['correo']; // Correo del usuario desde la sesión
$query = "SELECT * FROM registro WHERE correo='$correo'";
$resultado = mysqli_query($conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    // Si la consulta es exitosa y el usuario existe, obtenemos los datos
    $usuario = mysqli_fetch_assoc($resultado); // Almacenamos los datos en $usuario
} else {
    // Si no se encuentra el usuario, redirigimos
    echo '<script>alert("Usuario no encontrado."); window.location.href="../vista/index.php";</script>';
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
<link rel="stylesheet" href="../publico/css/nav.css">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../vista/bienvenida.php">Supermercado</a>

        <div class="dropdown">
            <a class="navbar-brand dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Producto
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../vista/producto.php">Ver Producto</a></li>
                <?php if ($rol === 'Administrador' || $rol === 'Vendedor'): ?>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#crearProductoModal">Crear Producto</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="dropdown">
            <a class="navbar-brand dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Categoría
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../vista/categoria.php">Ver Categorías</a></li>
                <?php if ($rol === 'Administrador' || $rol === 'Vendedor'): ?>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#crearCategoriaModal">Crear Categoría</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <?php if ($rol !== 'Comprador'): ?> 
            <div class="dropdown">
                <a class="navbar-brand dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    Proveedor
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="../vista/provedor.php">Ver Proveedores</a></li>
                    <?php if ($rol === 'Administrador' || $rol === 'Vendedor'): ?>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#crearProvedorModal">Crear Proveedor</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?> 

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <span class="navbar-text text-white" style="margin-right: 20px; margin-top: 5px; display: inline-block;">
                        <?= isset($rol) ? $rol : 'Sin Rol'; ?>
                    </span>
                </li>
                <li class="nav-item">
                    <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#perfilModal">Ver Perfil</button>
                </li>
                <li class="nav-item">
                    <a href="../modelos/logout.php" class="btn btn-danger">Cerrar Sesión</a>
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
          <form action="../modelos/provedor_base.php" method="POST" enctype="multipart/form-data">
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
          <h5 class="modal-title" id="crearCategoriaModalLabel">Crear Categoría</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="../modelos/categoria_base.php" method="POST" enctype="multipart/form-data">
            <div class="modal-footer">
              <input type="text" class="form-control mb-4" name="nombre_categoria" placeholder="Nombre de categoría" required>
              <input type="text" style="height: 90px;" class="form-control mb-4" name="tipo" placeholder="Tipo" required>
              <input type="email" class="form-control mb-4" name="correo" placeholder="Correo" required>

              <div class="mb-3">
                <label class="form-label">Imagen de Categoría:</label>
                <input type="file" class="form-control" name="imagen_categoria" required>
              </div>
              
              <button type="submit" class="btn btn-success">Guardar</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
<!-- Modal para agregar producto -->
<div class="modal fade" id="crearProductoModal" tabindex="-1" aria-labelledby="crearProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearProductoModalLabel">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../modelos/producto_be.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        
                        <input type="text" class="form-control" name="nombre_producto" placeholder="Nombre del producto" required>
                    </div>
                    <div class="mb-3">
                       
                        <textarea class="form-control" name="descripcion" placeholder="Descripción del producto" required style="height: 90px;"></textarea>
                    </div>
                    <div class="mb-3">
                        
                        <input type="number" class="form-control" name="precio" placeholder="Precio" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Imagen del Producto:</label>
                        <input type="file" class="form-control" name="imagen" accept="image/*" required>
                    </div>
                    
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
