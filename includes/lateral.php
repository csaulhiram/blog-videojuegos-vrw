<?php require_once './includes/helpers.php' ?>

<aside id="sidebar">
    <!-- BÚSQUEDA DE ENTRADAS -->
    <div id="buscador" class="bloque">
        <!-- LOGIN MENSAJE DE ERROR -->
        <h3>Buscar</h3>
        <form action="buscar.php" method="POST">
            <label for="busqueda">Buscar</label>
            <input type="text" name="busqueda" id="busqueda">

            <input type="submit" value="Entrar">
        </form>
    </div>

    <!-- LOGIN AND SIGN UP -->

    <!-- LOGIN SATISFACTORIO -->
    <?php if (isset($_SESSION['usuario'])) : ?>

        <div id="usuario-logueado" class="bloque">
            <h3>Bienvenido <br><?php echo $_SESSION['usuario']['nombre'] . " " .  $_SESSION['usuario']['apellidos']; ?></h3>

            <!-- BOTONES DE ACCIONES -->
            <a href="crear-entradas.php" class="boton boton-verde">Crear entradas</a>
            <a href="crear-categoria.php" class="boton">Crear categoría</a>
            <a href="mis-datos.php" class="boton boton-naranja">Mis datos</a>
            <a href="cerrar.php" class="boton boton-rojo">Cerrar Sesión</a>
        </div>
    <?php endif; ?>

    <?php if (!isset($_SESSION['usuario'])) : ?>
        <!-- Comprobación de usuario loggueado -->

        <div id="login" class="bloque">
            <!-- LOGIN MENSAJE DE ERROR -->
            <?php if (isset($_SESSION['error-login'])) : ?>
                <div class="alerta alerta-error">
                    <?php $_SESSION['error-login']; ?>
                    <h3><?php echo $_SESSION['error-login']; ?></h3>
                </div>
            <?php endif; ?>

            <h3>Identificate</h3>
            <form action="login.php" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">

                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password">

                <input type="submit" value="Entrar">
            </form>
        </div>

        <div id="register" class="bloque">
            <h3>Registrate</h3>


            <!-- Mostrar errores -->
            <?php if (isset($_SESSION['completado'])) : ?>
                <div class="alerta alerta-exito">
                    <?= $_SESSION['completado'] ?>
                </div>
            <?php elseif (isset($_SESSION['errores']['general'])) : ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['errores']['general'] ?>
                </div>
            <?php endif; ?>

            <form action="registro.php" method="POST">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre">
                <!-- Si existe la variable de sesión $_SESSION['errores'] entonces manda a llamar a la función -->
                <?php echo  isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''  ?>

                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" id="apellidos">
                <?php echo  isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''  ?>

                <label for="email">Email</label>
                <input type="email" name="email">
                <?php echo  isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''  ?>

                <label for="password">Contraseña</label>
                <input type="password" name="password">
                <?php echo  isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''  ?>

                <input type="submit" value="Registrar">
            </form>

            <?php borrarErrores(); ?>
        </div>
    <?php endif; ?>
</aside>