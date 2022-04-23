<?php
require_once './includes/conexion.php';
// Comprobar que se envió algo en el formulario
if (isset($_POST)) {

    // Recoger los valores del formualrio de registro
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conexion, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($conexion, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conexion, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conexion, $_POST['password']) : false;

    
    // Array de errores
    $errores = array();

    // validar la información antes de enviarlos a la base de datos
    // !preg_match("/[0-9]/", $nombre) => Si no hay un número

    /**
     * VALIDACIÓN NOMBRE
     */
    if (
        !empty($nombre) && !is_numeric($nombre)
        && !preg_match("/[0-9]/", $nombre)
    ) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es válido";
    }
    /**
     * VALIDACIÓN APELLIDOS
     */
    if (
        !empty($apellidos) && !is_numeric($apellidos)
        && !preg_match("/[0-9]/", $apellidos)
    ) {
        $apellidos_validado = true;
    } else {
        $apellidos_validado = false;
        $errores['apellidos'] = "Los apellidos no son válidos";
    }
    /**
     * VALIDACIÓN EMAIL
     */
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validado = true;
    } else {
        $email_validado = false;
        $errores['email'] = "El email no es válido";
    }

    /**
     * VALIDACIÓN CONTRASEÑA
     */
    if (!empty($password)) {
        $password_validado = true;
    } else {
        $password_validado = false;
        $errores['password'] = "La contraseña está vacía";
    }

    /**
     * INSERCIÓN EN LA BASE DE DATOS
     */
    $guardar_usuario = false;
    if (count($errores) == 0) {
        // insertar usuario en la base de datos 
        $guardar_usuario = true;

        // Cifrar la contraseña
        //password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]) => 
        //              contraseña, tipo de cifrado, número de vueltas
        // password_verify(contraseña_plana, contraseña_hash) => retorna true si son iguales
        //var_dump(password_verify($password, $password_segura));
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

        $query = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$password_segura', CURRENT_DATE);";
        $guardar = mysqli_query($conexion, $query);

        if ($guardar) {
            $_SESSION['completado'] = "El registro se ha completado con éxito";
        } else {
            $_SESSION['errores']['general'] = "Fallo al guardar al usuario";
        }
    } else {
        $_SESSION['errores'] = $errores;
        var_dump($_SESSION['errores']);
    }
}
header('Location: index.php');
