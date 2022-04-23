<?php './includes/redireccion.php' ?>
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

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Editar entradas</h1>

    <p>
        Edita tu entrada<?= $entradaActual['titulo']; ?>
    </p>
    <br>
    <!-- FORMULARIO DE REGISTRO DE ENTRADAS -->
    <!-- El action enviará un parámetro que se utilizará como bandera en el archivo
            guardar-entrada.php y así reulitizaremos la lógica escrita    
    -->
    <form action="guardar-entrada.php?editar=<?= $entradaActual['id']; ?>" method="POST">
        <label for="titulo"><strong>Título de la entrada</strong></label>
        <!-- Error si es que hubo -->
        <?php echo  isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''  ?>
        <input type="text" name="titulo" value="<?= $entradaActual['titulo']; ?>">
        <label for="descripcion">Descripción</label>
        <!-- Error si es que hubo -->
        <?php echo  isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''  ?>
        <textarea name="descripcion" id="" cols="50" rows="10"><?= $entradaActual['descripcion']; ?></textarea>

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
                    <option value="<?= $categoria['id'] ?>" <?= ($categoria['id'] == $entradaActual['categoria_id']) ? 'selected="selected"' : '' ?>>
                        <!-- mostrará seleccionada la categoría de la entrada a modificar -->
                        <?= $categoria['nombre'] ?>
                    </option>
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

<!-- FOOTER -->
<?php require_once './includes/pie.php' ?>