<?php
require_once 'includes/redireccion.php';
require_once 'includes/cabecera.php';
require_once 'includes/lateral.php';
?>
<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Crear entradas</h1>

    <p>
        Añade nuevas entradas al blog para que los usuarios
        puedan leerlas y disfrutar de nuestro contenido.
    </p>
    <br>
    <!-- FORMULARIO DE REGISTRO DE ENTRADAS -->
    <form action="guardar-entrada.php" method="POST">
        <label for="titulo"><strong>Título de la entrada</strong></label>
        <!-- Error si es que hubo -->
        <?php echo  isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''  ?>
        <input type="text" name="titulo">

        <label for="descripcion">Descripción</label>
        <!-- Error si es que hubo -->
        <?php echo  isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''  ?>
        <textarea name="descripcion" id="" cols="50" rows="10"></textarea>

        <!-- MOSTRAR LAS CATEGORÍAS EXISTENTES EN LA BD
             EN UN LAS OPCIONES DE UN SELECT
        -->
        <label for="categoria">Categoría</label>
        <select name="categoria">
            <!-- Error si es que hubo -->
            <?php echo  isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''  ?>

            <?php
            $categorias = conseguirCategorias($conexion);

            if (!empty($categorias)) :
                while ($categoria = mysqli_fetch_assoc($categorias)) :
            ?>
                    <!-- Envía el id de la categoría  a la BD -->
                    <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
            <?php
                endwhile;
            endif;
            ?>

        </select>
        <br>
        <input type="submit" value="Guardar">
    </form>
    
    <!-- BORRAR LOS ERRORES PASADOS DE LA SESIÓN $_SESSION['errores_entradas] -->
    <?php borrarErrores(); ?>
</div>


<?php require_once 'includes/pie.php'; ?>