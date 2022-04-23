<?php
require_once './includes/conexion.php';
// Comprobar que se envió algo en el formulario
if (isset($_POST)) {

    // Recoger los valores del formualrio de actualización
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conexion, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($conexion, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conexion, trim($_POST['email'])) : false;

    // Array de errores
    $errores = array();

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
     * INSERCIÓN EN LA BASE DE DATOS
     */
    $guardar_usuario = false;
    
    if (count($errores) == 0) {
        // Actualizar usuario en la base de datos 
        $guardar_usuario = true;
        // datos del usuario loggeado
        $usuario = $_SESSION['usuario'];

        // Comprobar si el usuario existe
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($conexion, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);

        // Solo actualizará si el usuario a modificar coincide con el usuario encontrado
        // o si no existe el usuario
        if ($isset_user['id'] == $usuario['id'] || empty($isset_user)) {
            //Actualización de los datos del usaurio
            $query = "UPDATE usuarios SET " .
                "nombre = '$nombre', " .
                "apellidos = '$apellidos', " .
                "email='$email'  " .
                "WHERE id=" . $usuario['id'];
            $guardar = mysqli_query($conexion, $query);



            if ($guardar) {
                // Actualización de datos de la sesión del usuario
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;

                $_SESSION['completado'] = "Los datos se han actualizado correctamente";
            } else {
                $_SESSION['errores']['general'] = "Fallo al actualizar tus datos";
            }
        } else {
            $_SESSION['errores']['general'] = "El usuario ya existe!!";
        }
    } else {
        $_SESSION['errores'] = $errores;
    }
}
header('Location: mis-datos.php');
