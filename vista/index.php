<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermercado - Login y Registro</title>
    <link rel="stylesheet" href="../publico/css/estilos.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="https://mir-s3-cdn-cf.behance.net/projects/404/671fe6173005403.6488f2526352b.jpg" alt="Supermercado Logo">
    </div>
    <div class="login-register">
        <!-- Formulario de Login -->
        <div class="form-container" id="login-form">
            <h2>Iniciar Sesión</h2>
            <form action="../modelos/login.php" method="POST">
                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="correo" placeholder="Correo" required>
                </div>
                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="contraseña" placeholder="Contraseña" required>
                </div>
                <div class="input-box">
                    <button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i> Ingresar</button>
                    <p>¿No tienes cuenta? <a href="#" id="switch-to-register">Regístrate</a></p>
                </div>
            </form>
        </div>

        <!-- Formulario de Registro -->
        <div class="form-container hidden" id="register-form">
            <h2>Registrarse</h2>
            <form action="../modelos/registro.php" method="POST">
                <div class="input-box">
                    <i class="fas fa-id-card"></i>
                    <input type="text" name="documento" placeholder="Documento" required>
                </div>
                <div class="input-box">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nombre" placeholder="Nombre" required>
                </div>
                <div class="input-box">
                    <i class="fas fa-user-circle"></i>
                    <input type="text" name="usuario" placeholder="Usuario" required>
                </div>
                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="correo" placeholder="Correo" required>
                </div>
                <div class="input-box">
                    <i class="fas fa-phone"></i>
                    <input type="text" name="numero" placeholder="Número" required>
                </div>
                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="contraseña" placeholder="Contraseña" required>
                </div>
                <div class="input-box">
                    <label for="rol">Selecciona tu rol:</label>
                    <select id="rol" name="rol" required>
                        <option value="Administrador">Administrador</option>
                        <option value="Vendedor">Vendedor</option>
                        <option value="Comprador">Comprador</option>
                    </select>
                </div>
                <button type="submit" class="btn"><i class="fas fa-user-plus"></i> Registrarse</button>
                <p>¿Ya tienes cuenta? <a href="#" id="switch-to-login">Inicia sesión</a></p>
            </form>
        </div>

    </div>
</div>

<script>
// Obtener los botones para cambiar entre los formularios
const switchToRegister = document.getElementById('switch-to-register');
const switchToLogin = document.getElementById('switch-to-login');

// Obtener los formularios
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');

// Evento para cambiar al formulario de registro
switchToRegister.addEventListener('click', () => {
    loginForm.classList.add('hidden');
    registerForm.classList.remove('hidden');
});

// Evento para cambiar al formulario de inicio de sesión
switchToLogin.addEventListener('click', () => {
    registerForm.classList.add('hidden');
    loginForm.classList.remove('hidden');
});
</script>

</body>
</html>
