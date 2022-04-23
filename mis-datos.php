<?php
require_once 'includes/redireccion.php';
require_once 'includes/cabecera.php';
require_once 'includes/lateral.php';
?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Mis datos</h1>
    <!-- MENSAJES DE ALERTA SATISFACTORIA O DE ERROR -->
    <?php
    if (isset($_SESSION['completado'])) : ?>
        <div class="alerta alerta-exito">
            <?= $_SESSION['completado'] ?>
        </div>
    <?php
    elseif (isset($_SESSION['errores']['general'])) : ?>
        <div class="alerta alerta-error">
            <?= $_SESSION['errores']['general'] ?>
        </div>
    <?php endif; ?>

    <form action="actualizar-usuario.php" method="POST">
        <label for="nombre">Nombre</label>
        <!-- Si existe la variable de sesión $_SESSION['errores'] entonces mostrará el error -->
        <?php echo  isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''  ?>
        <!-- Mostrar los datos del usuario loggeado -->
        <input type="text" name="nombre" id="nombre" value="<?= $_SESSION['usuario']['nombre']; ?>">

        <label for="apellidos">Apellidos</label>
        <?php echo  isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''  ?>
        <input type="text" name="apellidos" id="apellidos" value="<?= $_SESSION['usuario']['apellidos']; ?>">

        <label for="email">Email</label>
        <?php echo  isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''  ?>
        <input type="email" name="email" value="<?= $_SESSION['usuario']['email']; ?>">

        <input type="submit" value="Actualizar">
    </form>

    <?php borrarErrores(); ?>

</div>

<!-- FOOTER -->
<?php require_once './includes/pie.php' ?>