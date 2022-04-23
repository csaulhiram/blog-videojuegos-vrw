<?php
require_once './includes/conexion.php';

if (isset($_POST)) {

    // Obtenemos información del formulario solo si exite el input->name="nombre"
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conexion, $_POST['nombre']) : false;

    $errores = array();

    // Validación de la variable nombre
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es válido";
    }

    // Si no hay errores de validación entonces ejecuta la query
    if (count($errores) == 0) {
        $sql = "INSERT INTO categorias(nombre) VALUES('$nombre');";
        $guardar = mysqli_query($conexion, $sql);
    }
}


header('Location: index.php');
