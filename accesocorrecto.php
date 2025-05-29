<?php
session_start();

// Verificar si el usuario está logueado (tanto por formulario como por Google)
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
    // Si no está logueado, redirigir al login
    header("Location: index.php");
    exit();
}

// Obtener información del usuario según el tipo de login
$usuario = $_SESSION["email"] ?? $_SESSION["usuario"] ?? "Usuario";
$nombre = $_SESSION["nombre"] ?? $usuario;
$tipo_login = $_SESSION["tipo_login"] ?? "formulario";
$foto = $_SESSION["foto"] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-card">
            <h1 class="welcome-title">¡Bienvenido!</h1>
            
            <?php if ($foto): ?>
                <img src="<?php echo htmlspecialchars($foto); ?>" alt="Foto de perfil" style="width: 80px; height: 80px; border-radius: 50%; margin: 10px 0;">
            <?php endif; ?>
            
            <p class="welcome-text">Hola <strong><?php echo htmlspecialchars($nombre); ?></strong></p>
            <p class="welcome-text">Has iniciado sesión correctamente en el sistema.</p>
            
            <?php if ($tipo_login === 'google'): ?>
                <p class="welcome-text"><small>Conectado con Google (<?php echo htmlspecialchars($usuario); ?>)</small></p>
            <?php endif; ?>
            
            <a href="logout.php" class="btn-primary" style="text-decoration: none; display: inline-block;">Cerrar Sesión</a>
        </div>
    </div>
</body>
</html>