<?php
require_once "db_config.php";

$action = $_POST["action"];
$id_cliente = $_POST["id_cliente"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$direccion = $_POST["direccion"];
$ciudad = $_POST["ciudad"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];

if ($action == "create") {
    $sql = "INSERT INTO Clientes (Nombre, Apellido, Dirección, Ciudad, Teléfono, Correo_electrónico) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $apellido, $direccion, $ciudad, $telefono, $correo);
    if($stmt->execute()){
        echo "Cliente añadido con éxito.";
    } else {
        echo "Error al añadir cliente: " . $conn->error;
    }
} else if ($action == "update") {
    $sql = "UPDATE Clientes SET Nombre=?, Apellido=?, Dirección=?, Ciudad=?, Teléfono=?, Correo_electrónico=? WHERE ID_Cliente=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nombre, $apellido, $direccion, $ciudad, $telefono, $correo, $id_cliente);
    if($stmt->execute()){
        echo "Cliente actualizado con éxito.";
    } else {
        echo "Error al actualizar cliente: " . $conn->error;
    }
} else if ($action == "delete") {
    $sql = "DELETE FROM Clientes WHERE ID_Cliente=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_cliente);
    if($stmt->execute()){
        echo "Cliente eliminado con éxito.";
    } else {
        echo "Error al eliminar cliente: " . $conn->error;
    }
}

$stmt->close();
$conn->close();
?>
