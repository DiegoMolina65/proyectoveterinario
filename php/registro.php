<?php
require_once "db_config.php";

$nombre_usuario = $_POST["nombre_usuario"];
$correo_electronico = $_POST["correo_electronico"];
$contraseña = $_POST["contraseña"];

// Verificación de datos vacíos
if (empty($nombre_usuario) || empty($correo_electronico) || empty($contraseña)) {
  echo "Por favor, complete todos los campos.";
  exit();
}

$contraseña_cifrada = password_hash($contraseña, PASSWORD_DEFAULT);

$sql = "INSERT INTO Usuarios (Nombre_Usuario, Correo_electrónico, Contraseña)
VALUES ('$nombre_usuario', '$correo_electronico', '$contraseña_cifrada')";

if ($conn->query($sql) === TRUE) {
  echo "Registro exitoso. Ahora puedes iniciar sesión.";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
