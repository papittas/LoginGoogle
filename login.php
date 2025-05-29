<?php
    //Conexion con la base
    include("dbconn.php");

if(isset($_POST['Enviar'])) {
// Obtener las credenciales del formulario

$user = trim($_POST['User']);
$password = $_POST['pass'];


// Verificar si el usuario existe en la base de datos
$sql = "SELECT * FROM registronuevo WHERE user = '$user'";
$result = mysqli_query($conex, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $hashedPassword = $row['pass'];

    if (password_verify($password, $hashedPassword)) {
        // Contraseña correcta, iniciar sesión
    
        session_start();
        $_SESSION["user"] = $user;
        header("Location: accesocorrecto.php");
        exit;
    } else {
        // Contraseña incorrecta
        echo "Contraseña incorrecta.";
    }
} else {
    // Usuario inexistente
    echo "Usuario inexistente.";
}

mysqli_close($conex);
}

?>
