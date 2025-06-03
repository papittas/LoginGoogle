<?php 
//Conexion con la base
include("dbconn.php");
$email = $_GET['e'];
$token = $_GET['t'];

$c = "SELECT clave_nueva FROM recuperar WHERE email='$email' AND token='$token' LIMIT 1 ";
$f = mysqli_query( $conex, $c );
$a = mysqli_fetch_assoc($f);
if( ! $a ){
    $error = 'Solicitud no encontrada o expirada';
} else {
    //OBTENEMOS LA CLAVE Y ACTUALIZAMOS AL USUARIO
    $clave = $a['clave_nueva'];
    $clave_=sha1($clave);
    $clave_ = password_hash($clave,PASSWORD_DEFAULT, array("cost"=>10));
    $c2 = "UPDATE registronuevo SET pass='$clave_' WHERE email='$email' LIMIT 1";
    mysqli_query($conex, $c2);

    //ELIMINAR ESTA SOLICITUD DE RECUPERO
    $c3 = "DELETE FROM recuperar WHERE email='$email' LIMIT 1";
    mysqli_query($conex, $c3);

    $success = 'Contraseña actualizada satisfactoriamente, ya puedes iniciar sesión con tu nueva contraseña.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Recuperación</title>
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="main-card">
            <h1 class="main-title">Recuperación de Contraseña</h1>
            
            <?php if (isset($error)): ?>
                <div class="error-msg"><?php echo $error; ?></div>
                <div class="links-container">
                    <a href="recuperar_clave.php" class="btn-secondary">Solicitar nuevamente</a>
                    <div class="register-text mt-3">
                        <a href="index.php" class="register-link">Volver al inicio</a>
                    </div>
                </div>
            <?php elseif (isset($success)): ?>
                <div class="success-msg"><?php echo $success; ?></div>
                <div class="links-container">
                    <a href="index.php" class="btn-primary" style="text-decoration: none; display: inline-block;">Iniciar Sesión</a>
                </div>
                <script>
                    // Redireccionar automáticamente después de 3 segundos
                    setTimeout(function(){ 
                        window.location.href = "index.php"; 
                    }, 3000);
                </script>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
