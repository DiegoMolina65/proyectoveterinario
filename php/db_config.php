<?php

$host = "localhost";
$db_username = "phpmyadmin";
$db_password = "admin";
$db_name = "veterinario_web";
$db_charset = "utf8mb4";

class Database
{
    private $host;
    private $username;
    private $password;
    private $dbname;
    private $charset;
    
    public function __construct($host, $username, $password, $dbname, $charset)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->charset = $charset;
    }

    public function connect()
    {
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo = new PDO($dsn, $this->username, $this->password, $options);

            // Agregar mensaje emergente para verificar la conexión
            echo "<script>alert('Conexión exitosa a la base de datos');</script>";

            return $pdo;
        } catch (PDOException $e) {
            echo "<script>alert('Error de conexión: " . $e->getMessage() . "');</script>";
        }
    }
}

// Crear una instancia de la clase Database
$db = new Database($host, $db_username, $db_password, $db_name, $db_charset);
// Establecer conexión con la base de datos
$conn = $db->connect();

// Asegúrate de que el objeto de conexión esté disponible en otros archivos
// Puedes usar $conn en otros archivos incluyendo este archivo

?>
