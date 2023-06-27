<?php

// Los detalles de la base de datos se definen como constantes
class Database
{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;
    
    public function __construct()
    {
        $this->host = constant('localhost');
        $this->db = constant('veterinario_web');
        $this->user = constant('phpmyadmin');
        $this->password = constant('admin');
        $this->charset = constant('CHARSET');
    }

    function connect()
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
?>

