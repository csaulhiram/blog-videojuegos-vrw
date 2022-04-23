<?php require_once './includes/cabecera.php' ?>


<!-- BARRA LATERAL -->
<?php require_once './includes/lateral.php' ?>


<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Todas las entradas</h1>
    <?php
    $entradas = consegiorEntradas($conexion);
    // Comprobar que el array entradas noe sté vacío
    if (!empty($entradas)) :
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
    endif;
    ?>
</div>

<!-- FOOTER -->
<?php require_once './includes/pie.php' ?>