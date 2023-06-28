<?php
require_once 'db_config.php';

$nombre_usuario = $_POST["nombre_usuario"];
$contraseña = $_POST["contraseña"];

// Verificación de datos vacíos
if (empty($nombre_usuario) || empty($contraseña)) {
  echo "Por favor, complete todos los campos.";
  exit();
}

$sql = "SELECT Contraseña FROM Usuarios WHERE Nombre_Usuario='$nombre_usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  if (password_verify($contraseña, $row["Contraseña"])) {
    header("Location: ../html/info.html");;
    exit();
  } else {
    echo "Contraseña incorrecta.";
  }
} else {
  echo "No existe un usuario con ese nombre de usuario.";
}

$conn->close();
?>
