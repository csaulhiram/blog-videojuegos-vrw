<?php
require_once './includes/conexion.php';

if (isset($_POST)) {

    // Obtenemos información del formulario solo si exite el input->name="nombre"
    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($conexion, $_POST['titulo']) : false;
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($conexion, $_POST['descripcion']) : false;
    $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
    $usuario =  $_SESSION['usuario']['id'];

    $errores = array();

    // Validación de la variable nombre
    if (empty($titulo)) {
        $errores['titulo'] = "El nombre no es válido";
    }

    if (empty($descripcion)) {
        $errores['descripcion'] = "La descripción no es válida";
    }

    if (empty($categoria) && !is_numeric($categoria)) {
        $errores['categoria'] = "La categoría no es válida";
    }

    // Si no hay errores de validación entonces ejecuta la query
    if (count($errores) == 0) {
        $entrada_id = $_GET['editar'];
        $usuario_id = $_SESSION['usuario']['id'];
        if (isset($_GET['editar'])) {
            $sql = "UPDATE entradas SET titulo = '$titulo', descripcion = '$descripcion', categoria_id =  $categoria " .
                "WHERE id= $entrada_id AND usuario_id = $usuario_id";
        } else {
            $sql = "INSERT INTO entradas(usuario_id, categoria_id, titulo, descripcion, fecha) 
                    VALUES($usuario, $categoria, '$titulo', '$descripcion', CURRENT_DATE);";
        }

        $guardar = mysqli_query($conexion, $sql);
        header('Location: index.php');
    } else {
        $_SESSION['errores_entrada'] = $errores;
        if (isset($_GET['editar'])) {
            header('Location: editar-entrada.php?id=' . $_GET['editar']);
        } else {
            header('Location: crear-entradas.php');
        }
    }
}
