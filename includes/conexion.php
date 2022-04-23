<?php 
// conexión a la base de datos
$user = 'root';
$server = 'localhost';
$password = '';
$database = 'blog';

$conexion = mysqli_connect($server, $user, $password, $database);


mysqli_query($conexion, 'SET NAMES "utf8"');

// Iniciar la sesión
if(!isset($_SESSION)) {
    session_start();
}