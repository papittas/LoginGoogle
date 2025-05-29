<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <?php
    //Conexion con la base
    include_once("dbconn.php")
    ?>
    
    <div class="main-container">
        <div class="main-card">
            <h1 class="main-title">Crear Cuenta</h1>
            
            <?php    
            if(isset($_POST['Enviar'])) {
                if(strlen($_POST['nombre']) >= 1 && strlen($_POST['apellido']) >= 1 && strlen($_POST['email']) >= 1 && strlen($_POST['User']) >= 1 && strlen($_POST['password']) >= 1 && $_POST['password'] === $_POST['Cpassword']) {
                    $nombre=trim($_POST['nombre']);
                    $apellido=trim($_POST['apellido']);
                    $email=trim($_POST['email']);
                    $User=trim($_POST['User']);
                    $password = $_POST['password'];
                    $pass_cifrada = password_hash($password,PASSWORD_DEFAULT, array("cost"=>10));
                    $consulta = "INSERT INTO registronuevo (nombre, apellido, email, user, pass) VALUES ('$nombre','$apellido','$email','$User','$pass_cifrada')";
                    $resultado = mysqli_query($conex,$consulta);
                    if ($resultado) {
                        echo '<div class="success-msg">¡Te has inscripto correctamente!</div>';
                        echo '<script>setTimeout(function(){ window.location.href = "accesocorrecto.php"; }, 2000);</script>';
                    } else {
                        echo '<div class="error-msg">¡Ups ha ocurrido un error!</div>';
                    }
                } else {
                    echo '<div class="error-msg">¡Por favor complete todos los campos y asegúrese de que las contraseñas coincidan!</div>';
                }
            }
            ?>
            
            <form action="alta.php" method="post" class="simple-form">
                <div class="form-row">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control-custom" placeholder="Ingrese su nombre" required>
                </div>
                
                <div class="form-row">
                    <label class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control-custom" placeholder="Ingrese su apellido" required>
                </div>
                
                <div class="form-row">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control-custom" placeholder="Ingrese su email" required>
                </div>
                
                <div class="form-row">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="User" class="form-control-custom" placeholder="Ingrese nombre de usuario" required>
                </div>
                
                <div class="form-row">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control-custom" placeholder="Ingrese contraseña" required>
                </div>
                
                <div class="form-row">
                    <label class="form-label">Confirmar Contraseña</label>
                    <input type="password" name="Cpassword" class="form-control-custom" placeholder="Confirme su contraseña" required>
                </div>
                
                <button type="submit" name="Enviar" class="btn-primary">Registrarse</button>
            </form>
            
            <div class="links-container">
                <div class="register-text">
                    ¿Ya tienes cuenta? <a href="index.php" class="register-link">Inicia sesión</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>