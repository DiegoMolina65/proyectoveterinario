<?php
require_once "db_config.php";

$conn = new mysqli($host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

$nombre_usuario = $_POST["nombre_usuario"];
$contraseña = $_POST["contraseña"];
$correo = $_POST["correo"];
$rol = $_POST["rol"];

if (empty($nombre_usuario) || empty($contraseña) || empty($correo)) {
  echo "Por favor, complete todos los campos.";
  exit();
}

$contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

$sql = "INSERT INTO Usuarios (Nombre_Usuario, Contraseña, Correo_electrónico, Rol) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nombre_usuario, $contraseña_hash, $correo, $rol);

if ($stmt->execute()) {
  header("Location: ../html/login.html"); // redirige a la página de inicio de sesión después del registro exitoso
  exit();
} else {
  echo "Error al registrar usuario: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
