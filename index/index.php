<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermercado - Login y Registro</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
        <div class="logo">
            <img src="https://mir-s3-cdn-cf.behance.net/projects/404/671fe6173005403.6488f2526352b.jpg" alt="Supermercado Logo">
        </div>
        <div class="login-register">
            <div class="form-container" id="login-form">
                <h2>Iniciar Sesión</h2>
                <form action="../php/login.php" method="POST">
                    <div class="input-box">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="correo" placeholder="Correo" required>
                    </div>
                    <div class="input-box">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="contraseña" placeholder="Contraseña" required>
                    </div>
                    <button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i> Ingresar</button>
                    <p>¿No tienes cuenta? <a href="#" id="switch-to-register">Regístrate</a></p>
                </form>
            </div>
            
            <form id="register-form" action="../php/registro.php" method="POST" class="hidden">
    <div class="input-box">
        <i class="fas fa-id-card"></i>
        <input type="text" name="documento" placeholder="documento" required>
    </div>
    <div class="input-box">
        <i class="fas fa-user"></i>
        <input type="text" name="nombre" placeholder="nombre" required>
    </div>
    <div class="input-box">
        <i class="fas fa-user-circle"></i>
        <input type="text" name="usuario" placeholder="usuario" required>
    </div>
    <div class="input-box">
        <i class="fas fa-envelope"></i>
        <input type="email" name="correo" placeholder="correo" required>
    </div>
    <div class="input-box">
        <i class="fas fa-phone"></i>
        <input type="text" name="numero" placeholder="número" required>
    </div>
    <div class="input-box">
        <i class="fas fa-lock"></i>
        <input type="password" name="contraseña" placeholder="contraseña" required>
    </div>
    <button type="submit" class="btn"><i class="fas fa-user-plus"></i> Registrarse</button>
    <p>¿Ya tienes cuenta? <a href="#" id="switch-to-login">Inicia sesión</a></p>
</form>

        </div>
    </div>
    <script src="java.js"></script>
</body>
</html>
