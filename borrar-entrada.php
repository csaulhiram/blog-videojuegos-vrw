<?php
require_once './includes/conexion.php';

/* 
    Verificar que el usuario esté autenticado 
    y que exista el parámetro id en la variable $_GET
*/
if (isset($_SESSION['usuario']) && isset($_GET['id'])) {
    $entrada_id =  $_GET['id'];
    $usuario_id = $_SESSION['usuario']['id'];

    /* ELIMINAR ENTRADA */
    $sql = "DELETE FROM entradas WHERE usuario_id = $usuario_id AND id = $entrada_id";
    mysqli_query($conexion, $sql);
}

header('Location: index.php');