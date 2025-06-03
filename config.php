<?php
session_start(); // ¡Importante! Iniciar sesión al principio

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('975567081498-XXXXXXXXXXXXXXXXXXX.apps.googleusercontent.com');
$client->setClientSecret('GOCSPX-XXXXXXXXXXXXXXXXX');
$client->setRedirectUri('http://localhost/config.php');
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    echo "Código recibido: " . htmlspecialchars($_GET['code']) . "<br>";

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (isset($token['error'])) {
        echo "Error al obtener token: " . $token['error_description'];
        exit;
    }

    $client->setAccessToken($token['access_token']);

    $oauth = new Google_Service_Oauth2($client);
    $userInfo = $oauth->userinfo->get();

    // Debug de datos
    echo "<pre>";
    print_r($userInfo);
    echo "</pre>";

    // Guardar datos del usuario en la sesión
    $_SESSION['access_token'] = $token;
    $_SESSION['logueado'] = true; // Bandera para verificar login
    $_SESSION['tipo_login'] = 'google'; // Identificar tipo de login
    $_SESSION['email'] = $userInfo->email;
    $_SESSION['nombre'] = $userInfo->name;
    $_SESSION['usuario'] = $userInfo->email; // Para compatibilidad con el código existente
    
    // Opcional: Guardar también la foto del usuario
    if (isset($userInfo->picture)) {
        $_SESSION['foto'] = $userInfo->picture;
    }

    // Redirigir a accesocorrecto.php
    header('Location: accesocorrecto.php');
    exit();

} else {
    echo "No se recibió el parámetro 'code'";
}
?>



