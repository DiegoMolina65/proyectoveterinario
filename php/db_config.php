<?php

// Los detalles de la base de datos se definen como constantes
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'phpmyadmin'); 
define('DB_PASSWORD', 'admin');
define('DB_NAME', 'veterinario_web');

// Conexión a la base de datos MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verificar la conexión
if($conn === false){
    die("ERROR: No se pudo conectar a la base de datos. " . mysqli_connect_error());
}
?>
