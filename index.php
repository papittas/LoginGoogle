<?php
session_start(); // Iniciar sesión al principio

// Si ya está logueado, redirigir a accesocorrecto.php
if (isset($_SESSION['logueado']) && $_SESSION['logueado'] === true) {
    header("Location: accesocorrecto.php");
    exit();
}

//Conexion con la base
include_once("dbconn.php");

$mensaje = '';
$tipo_mensaje = '';

if(isset($_POST['Enviar'])) {
    // Obtener las credenciales del formulario
    $usuario = trim($_POST['User']);
    $password = $_POST['pass'];

    // Verificar si el usuario existe en la base de datos
    $sql = "SELECT * FROM registronuevo WHERE user = '$usuario'";
    $result = mysqli_query($conex, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['pass'];

        if (password_verify($password, $hashedPassword)) {
            // Contraseña correcta, iniciar sesión
            $_SESSION["usuario"] = $usuario;
            $_SESSION["logueado"] = true; // Bandera para verificar login
            $_SESSION["tipo_login"] = "formulario"; // Identificar tipo de login
            header("Location: accesocorrecto.php");
            exit();
        } else {
            // Contraseña incorrecta
            $mensaje = "Contraseña incorrecta.";
            $tipo_mensaje = "error";
        }
    } else {
        // Usuario inexistente
        $mensaje = "Usuario inexistente.";
        $tipo_mensaje = "error";
    }

    mysqli_close($conex);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="main-card">
            <h1 class="main-title">Inicia sesión</h1>
            <?php if (!empty($mensaje)) echo "<div class='error-msg'>$mensaje</div>"; ?>
            
            <!-- Botón de Google -->
            <?php
            require_once 'vendor/autoload.php';

            $client = new Google_Client();
            $client->setClientId('975567081498-voblkm52uont1r9meijv4v65j32hdgsn.apps.googleusercontent.com');
            $client->setClientSecret('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');
            $client->setRedirectUri('http://localhost/config.php');
            $client->addScope("email");
            $client->addScope("profile");

            $login_url = $client->createAuthUrl();

            //echo "<a href='$login_url' class='btn-google' style='text-decoration: none; display: block; margin-bottom: 20px; text-align: center;'>Continuar con Google</a>";
            ?>
            <a href="<?php echo $login_url; ?>" class="btn-google">
    <svg class="google-icon" viewBox="0 0 24 24">
        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
    </svg>
    Continuar con Google
</a>
            <hr class="hr">
            <hr>
            <!-- Formulario de login tradicional -->
            <form action="index.php" method="POST">
                <input type="text" name="User" class="form-control-custom" placeholder="Email o usuario" required>
                <div class="password-container">
                    <input type="password" name="pass" id="password" class="form-control-custom" placeholder="Contraseña" style="padding-right: 45px;" required>
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <svg id="eyeIcon" class="eye-icon" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        <svg id="eyeOffIcon" class="eye-icon" style="display: none;" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                            <line x1="2" y1="2" x2="22" y2="22"></line>
                        </svg>
                        
                    </button>
                </div>
                <button type="submit" class="btn-primary" name='Enviar'>Iniciar Sesión</button>
            </form>
            
            <div class="links-container">
                <a href="recuperar_clave.php" class="forgot-password d-block mb-3 mx-auto">¿Has olvidado la contraseña?</a>
                <div class="register-text">
                    ¿No tenés cuenta? <a href="alta.php" class="register-link">Regístrate</a>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const eye = document.getElementById('eyeIcon');
            const eyeOff = document.getElementById('eyeOffIcon');
            if (input.type === "password") {
                input.type = "text";
                eye.style.display = "none";
                eyeOff.style.display = "block";
            } else {
                input.type = "password";
                eye.style.display = "block";
                eyeOff.style.display = "none";
            }
        }
    </script>
</body>
</html>
