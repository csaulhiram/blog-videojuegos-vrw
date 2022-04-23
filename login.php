<?php

// iniciar la sesión y la conexión a la base de datos
require_once './includes/conexion.php';

// Recoger los datos del formulario 
if (isset($_POST)) {
    // Borrar error antiguo
    if (isset($_SESSION['error-login'])) {
        unset($_SESSION['error-login']);
    }
    
    // recojo datos del formulario 
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Consulta para validar las contraseñas del usuario
    $query = "SELECT * FROM usuarios WHERE email= '$email' LIMIT 1";
    $login =  mysqli_query($conexion, $query);

    if ($login  && mysqli_num_rows($login) == 1) {
        // datos obtenidos del usuario 
        $usuario = mysqli_fetch_assoc($login);

        // Verificar contraseña
        $verify = password_verify($password, $usuario['password']);

        // validar si la contraseña coincidió
        if ($verify) { // usuario autenticado
            // Utilizar una sesión para guardar los datos del usuario logueado
            $_SESSION['usuario'] = $usuario;
        } else { // error de contraseña distinta
            // Enviar una sesión con el fallo
            $_SESSION['error-login']  = "Login incorrecto";
        }
    } else {
        // mensaje de error
        $_SESSION['error-login']  = "Login incorrecto";
    }
}
// Redirigir al index
header('Location: index.php');
