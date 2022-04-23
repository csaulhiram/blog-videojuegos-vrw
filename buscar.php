<?php require_once './includes/cabecera.php' ?>
<?php require_once './includes/helpers.php' ?>
<?php
/* Validar que llegue el dato busqueda por $_POST*/
if (!isset($_POST['busqueda'])) {
    header('Location: index.php');
}
?>

<!-- BARRA LATERAL -->
<?php require_once './includes/lateral.php' ?>


<!-- CAJA PRINCIPAL -->
<div id="principal">


    <h1>Busqueda: <?= $_POST['busqueda']; ?></h1>
    <?php
    /**
     * **********************************************************
     *      MOSTRAR INFORMACIÓN DE 1 ENTRADA EN ESPECÍFICO
     * **********************************************************
     */
    /* Obtener información de la entrada */
    $entradas =  consegiorEntradas($conexion, null, null, $_POST['busqueda']);
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