<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="main-card">
            <h1 class="main-title">Recuperar Contraseña</h1>
            <p class="info-msg">Ingresa tu email y te enviaremos instrucciones para recuperar tu contraseña.</p>
            
            <?php 
            if (isset($_POST['email']) && !empty($_POST['email'])) {
                //Conexion con la base
                include("dbconn.php");

                $email = mysqli_real_escape_string($conex, $_POST['email']);
                $c = "SELECT *, IFNULL(email, 'registronuevo') as email FROM registronuevo WHERE email='$email' LIMIT 1";
                $f = mysqli_query($conex, $c);
                $a = mysqli_fetch_assoc($f);
                if (!$a) {
                    echo '<div class="error-msg">Usuario inexistente</div>';
                } else {
                    //generar una clave aleatoria y el token
                    $token = md5($a['email'] . time() . rand(1000, 9999));
                    $clave_nueva = rand(10000000, 99999999);
                    $idusuario = $a['email'];
                    $c2 = "INSERT INTO recuperar SET email='$email', token='$token', fecha=NOW(), clave_nueva='$clave_nueva' ON DUPLICATE KEY UPDATE token='$token', clave_nueva='$clave_nueva'";
                    mysqli_query($conex, $c2);

                    $link = "http://localhost/recuperar_clave_confirmar.php?e=$email&t=$token";

                    //mensaje de confirmación
                    echo '<div class="success-msg">';
                    echo '<p><strong>Solicitud procesada correctamente</strong></p>';
                    echo '<p>Tu nueva contraseña temporal es: <code style="background: #2d3748; color: #10b981; padding: 2px 6px; border-radius: 4px;">' . $clave_nueva . '</code></p>';
                    echo '<p>Para activarla, haz clic en el siguiente enlace:</p>';
                    echo '<a href="' . $link . '" style="color: #10b981; word-break: break-all;">' . $link . '</a>';
                    echo '<p style="margin-top: 10px; font-size: 0.9em;">Si no has hecho esta solicitud, ignora este mensaje.</p>';
                    echo '</div>';
                }
            }
            ?>
            
            <form action="recuperar_clave.php" method="post" class="simple-form">
                <div class="form-row">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control-custom" placeholder="Ingrese su email" required>
                </div>
                <button type="submit" class="btn-primary">Enviar</button>
            </form>
            
            <div class="links-container">
                <div class="register-text">
                    ¿Recordaste tu contraseña? <a href="index.php" class="register-link">Inicia sesión</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>