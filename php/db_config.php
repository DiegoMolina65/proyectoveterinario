<?php

// Los detalles de la base de datos se definen como constantes
define('DB_HOST', 'localhost');
define('DB_NAME', 'veterinario_web');
define('DB_USER', 'phpmyadmin');
define('DB_PASSWORD', 'admin');
define('DB_CHARSET', 'utf8mb4');

class Database
{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;
    
    public function __construct()
    {
        $this->host = DB_HOST;
        $this->db = DB_NAME;
        $this->user = DB_USER;
        $this->password = DB_PASSWORD;
        $this->charset = DB_CHARSET;
    }

    public function connect()
    {
        try {
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo = new PDO($connection, $this->user, $this->password, $options);

            // Agregar mensaje emergente para verificar la conexión
            echo "<script>alert('Conexión exitosa a la base de datos');</script>";

            return $pdo;
        } catch (PDOException $e) {
            echo "<script>alert('Error de conexión: " . $e->getMessage() . "');</script>";
        }
    }
}

// Crear una instancia de la clase Database
$db = new Database();
// Establecer conexión con la base de datos
$conn = $db->connect();

// Asegúrate de que el objeto de conexión esté disponible en otros archivos
// Puedes usar $conn en otros archivos incluyendo este archivo
