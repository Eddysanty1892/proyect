<?php
session_start();
session_destroy(); // Elimina todas las variables de sesión
header("Location: ../vista/index.php"); // Redirige al login
exit();
?>
