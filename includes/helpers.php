<?php
// Recibe los errores y el nombre del campo que tiene el error ($errores['nombre'])
function mostrarError($errores, $campo)
{
    $alerta = '';
    if (isset($errores[$campo]) && !empty($campo)) {
        $alerta = '<div class="alerta alerta-error">'
            . $errores[$campo] .
            '</div>';
    }

    return $alerta;
}

// Borra los errores y finaliza la sesión
function  borrarErrores()
{
    if (isset($_SESSION['errores'])) {
        $_SESSION['errores'] = null;
        $borrado = true;
    }

    if (isset($_SESSION['errores_entrada'])) {
        $borrado = true;
    }

    if (isset($_SESSION['completado'])) {
        $_SESSION['completado'] = null;
        $borrado = true;
    }
}



function conseguirCategorias($conexion)
{

    // Consulta de categorías
    $sql = 'SELECT * FROM categorias ORDER BY id ASC';
    $categorias = mysqli_query($conexion, $sql);

    $result =  array();
    // Si hay categorías las retornará, si no solo retorna un array vacío
    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        $resultado = $categorias;
    }

    return $resultado;
}


function consegiorEntradas($conexion, $limit = null, $categoria = null, $busqueda = null)
{
    $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e " .
        "INNER JOIN categorias c ON e.categoria_id = c.id ";

    // Búsqueda por categoria
    if (!empty($categoria)) {
        $sql .= " WHERE e.categoria_id = $categoria ORDER BY e.id DESC";

    }
    // Búsqueda personalizada por variable $busqueda
    if (!empty($busqueda)) {
        $sql .= " WHERE e.titulo LIKE '%$busqueda%'";
    }

    // Traer solo 4 tregistro
    if ($limit != null) {
        $sql .= ' ORDER BY e.id DESC LIMIT 4';
    }

    $entradas = mysqli_query($conexion, $sql);

    $resultado = array();
    if ($entradas && mysqli_num_rows($entradas) >= 1) {
        $resultado = $entradas;
    }
    return $resultado;
}


function conseguirCategoria($conexion, $idCategoria)
{

    // Consulta de categorías
    $sql = "SELECT * FROM categorias WHERE id = $idCategoria";
    $categoria = mysqli_query($conexion, $sql);

    $result =  array();
    // Si hay categorías las retornará, si no solo retorna un array vacío
    if ($categoria && mysqli_num_rows($categoria) >= 1) {
        $resultado = mysqli_fetch_assoc($categoria);
    }

    return $resultado;
}

function conseguirEntrada($conexion, $idEntrada)
{
/* WHERE id = $idEntrada */
    // Consulta de categorías
    $sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellidos) AS usuario FROM entradas e " .
        " INNER JOIN categorias c ON e.categoria_id = c.id " .
        " INNER JOIN usuarios u ON e.usuario_id = u.id " .
        "WHERE e.id = $idEntrada";

   
    $entrada = mysqli_query($conexion, $sql);
    $resultado = array();

    // Si hay categorías las retornará, si no solo retorna un array vacío
    if ($entrada && mysqli_num_rows($entrada) >= 1) {
        $resultado = mysqli_fetch_assoc($entrada);
    }

    return $resultado;
}