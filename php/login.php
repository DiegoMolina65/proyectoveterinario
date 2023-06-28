<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['nombre_usuario']) && !empty($_POST['contraseña'])) {
        $nombre_usuario = $_POST['nombre_usuario'];
        $contraseña = $_POST['contraseña'];

        $sql = "SELECT Contraseña FROM Usuarios WHERE Nombre_Usuario = :nombre_usuario";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die('Error en la preparación: ' . htmlspecialchars($conn->errorInfo()));
        }

        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            if (password_verify($contraseña, $result['Contraseña'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['nombre_usuario'] = $nombre_usuario;
                session_write_close();
                header("Location: ../html/info.html");
                exit();
            } else {
                echo 'Contraseña incorrecta.';
            }
        } else {
            echo 'No existe un usuario con ese nombre de usuario.';
        }
    } else {
        echo 'Por favor, complete todos los campos.';
    }
}

$conn = null;
?>
