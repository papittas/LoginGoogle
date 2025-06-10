# Login con Google - PHP

Este proyecto implementa un sistema de inicio de sesión con autenticación de Google usando PHP. Permite a los usuarios registrarse, iniciar sesión, recuperar contraseñas y manejar sesiones de manera segura.

## 🚀 Características

- Autenticación con Google
- Registro y login de usuarios
- Recuperación de contraseña
- Manejo de sesiones
- Diseño básico con CSS

## 📁 Estructura del Proyecto

```
LoginGoogle-main/
│
├── index.php
├── login.php
├── alta.php
├── logout.php
├── accesocorrecto.php
├── recuperar_clave.php
├── recuperar_clave_confirmar.php
├── config.php
├── dbconn.php
├── nusuario.sql
├── css/styles.css
└── .gitignore
```

## 🛠️ Requisitos

- PHP 7.x o superior
- [XAMPP](https://www.apachefriends.org/es/index.html)
- [Composer](https://getcomposer.org/)
- Navegador web moderno
- Cuenta de Google y acceso a [Google Cloud Console](https://console.cloud.google.com/)

## ⚙️ Instalación (con XAMPP)

1. **Clonar o copiar el proyecto** a la carpeta `htdocs` de XAMPP:

   ```bash
   C:\xampp\htdocs\LoginGoogle-main
   ```

2. **Instalar dependencias con Composer** (si el proyecto lo requiere):

   Abre una terminal en la carpeta del proyecto y ejecuta:

   ```bash
   composer install
   ```

   > Nota: Este proyecto parece no incluir `composer.json` aún. Podés crear uno si planeás usar paquetes externos (como Google Client Library).

3. **Importar la base de datos**:

   - Ingresá a `http://localhost/phpmyadmin`
   - Creá una nueva base de datos (ej: `login_google`)
   - Importá el archivo `nusuario.sql`

4. **Configurar el archivo `config.php`**:

   - Ingresá tus claves de Google (Client ID, Client Secret y Redirect URI) que obtuviste desde la [Google Cloud Console](https://console.cloud.google.com/apis/credentials)

5. **Ejecutar la aplicación**:

   - Abrí tu navegador y andá a:  
     [http://localhost/LoginGoogle-main/index.php](http://localhost/LoginGoogle-main/index.php)

## 🔐 Autenticación con Google

Este sistema usa OAuth 2.0. Necesitás:

- Crear un proyecto en Google Cloud Console
- Habilitar la API de Google Login
- Obtener Client ID y Client Secret
- Configurar la URI de redirección a:  
  `http://localhost/LoginGoogle-main/index.php` (o el archivo que maneje la respuesta de Google)

## 🧑‍💻 Contribuciones

¡Contribuciones y mejoras son bienvenidas! Podés abrir un issue o enviar un pull request.

## 📄 Licencia

Distribuido bajo la licencia MIT.
