<?php
session_start();

require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['nombre_usuario']) && !empty($_POST['contraseña'])) {
        $nombre_usuario = $_POST['nombre_usuario'];
        $contraseña = $_POST['contraseña'];

        $sql = "SELECT Contraseña FROM Usuarios WHERE Nombre_Usuario = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die('Error en la preparación: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param('s', $nombre_usuario);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($contraseña, $row['Contraseña'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['nombre_usuario'] = $nombre_usuario;
                header("Location: ../html/info.html");
                exit();
            } else {
                echo 'Contraseña incorrecta.';
            }
        } else {
            echo 'No existe un usuario con ese nombre de usuario.';
        }

        $stmt->close();
    } else {
        echo 'Por favor, complete todos los campos.';
    }
}

$conn->close();
?>
