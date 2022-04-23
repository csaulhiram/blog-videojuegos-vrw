<?php require_once './includes/cabecera.php' ?>
<?php require_once 'includes/helpers.php'; ?>

<?php
/* Obtener información de la entrda */
$entradaActual =  conseguirEntrada($conexion, $_GET['id']);

/* Validar que ese id haya traído información de la base de datos*/
if (!isset($entradaActual['id'])) {
    header('Location: index.php');
}
?>

<!-- BARRA LATERAL -->
<?php require_once './includes/lateral.php' ?>

<!-- ***************************************
    MOSTRAMOS LA INFORMACIÓN DE LA ENTRDA

    ***************************************-->
<!-- CAJA PRINCIPAL -->
<div id="principal">

    <h1><?= $entradaActual['titulo']; ?></h1>
    <a href="categoria.php?id=<?= $entradaActual['categoria_id'] ?>">
        <h2><?= $entradaActual['categoria']; ?></h2>
    </a>
    <h4><?= $entradaActual['fecha']; ?> | <?= $entradaActual['usuario']; ?></h4>
    <p><?= $entradaActual['descripcion']; ?></p>


    <!-- Botones de edición 
        - Solo se mostrarán si el usuario 
            autenticado es el autor de la entrada
    -->
    <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entradaActual['usuario_id']) : ?>
        <a href="editar-entrada.php?id=<?=$entradaActual['id']?>" class="boton boton-verde">Editar entrada</a>
        <a href="borrar-entrada.php?id=<?=$entradaActual['id']?>" class="boton boton-rojo">Eliminar entrada</a>
    <?php endif; ?>
</div>

<!-- FOOTER -->
<?php require_once './includes/pie.php' ?>