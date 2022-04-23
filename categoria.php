<?php require_once './includes/cabecera.php' ?>
<?php require_once 'includes/helpers.php'; ?>

<?php
/* Obtener información de la categoría */
$categoriaActual =  conseguirCategoria($conexion, $_GET['id']);

/* Validar que ese id haya traído información de la base de datos*/
if (!isset($categoriaActual['id'])) {
    header('Location: index.php');
}
?>

<!-- BARRA LATERAL -->
<?php require_once './includes/lateral.php' ?>


<!-- CAJA PRINCIPAL -->
<div id="principal">


    <h1>Entradas de <?= $categoriaActual['nombre']; ?></h1>
    <?php
    /**
     * **********************************************************
     *      MOSTRAR INFORMACIÓN DE LAS CATEGORÍAS
     * **********************************************************
     */
    $entradas = consegiorEntradas($conexion, null, $_GET['id']);
    // Comprobar que el array entradas no esté vacío
    if (!empty($entradas) && mysqli_num_rows($entradas) >= 1) :
        // Crear variable $entrada por cada registro
        while ($entrada = mysqli_fetch_assoc($entradas)) :
    ?>
            <article class="entrada">
                <h2><a href="entrada.php?id=<?= $entrada['id']; ?>"><?= $entrada['titulo'] ?></a></h2>
                <span class="fecha"><?= $entrada['categoria'] . ' | ' .  $entrada['fecha'] ?></span>
                <p>
                    <!-- Solo mostrará 100 líneas -->
                    <?= substr($entrada['descripcion'], 0, 200) . "..." ?>
                </p>
            </article>
        <?php
        endwhile;
    else :
        ?>
        <div class="alerta">No hay entradas en esta categoría</div>
    <?php
    endif;
    ?>
</div>

<!-- FOOTER -->
<?php require_once './includes/pie.php' ?>