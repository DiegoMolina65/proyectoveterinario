<?php
require_once "db_config.php";

function checkEmptyFields($fields) {
    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            echo "Por favor, complete todos los campos.";
            exit();
        }
    }
}

$action = $_POST["action"] ?? '';
$nombre = $_POST["nombre"] ?? '';
$apellido = $_POST["apellido"] ?? '';
$direccion = $_POST["direccion"] ?? '';
$ciudad = $_POST["ciudad"] ?? '';
$telefono = $_POST["telefono"] ?? '';
$correo = $_POST["correo"] ?? '';

if ($action == "create") {
    checkEmptyFields(["nombre", "apellido", "direccion", "ciudad", "telefono", "correo"]);
    
    $sql = "INSERT INTO Clientes (Nombre, Apellido, Dirección, Ciudad, Teléfono, Correo_electrónico) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $apellido, $direccion, $ciudad, $telefono, $correo);
    if($stmt->execute()){
        echo "Cliente añadido con éxito.";
    } else {
        echo "Error al añadir cliente: " . $conn->error;
    }
} else if ($action == "update") {
    $id_cliente = $_POST["id_cliente"];
    checkEmptyFields(["nombre", "apellido", "direccion", "ciudad", "telefono", "correo", "id_cliente"]);
    
    $sql = "UPDATE Clientes SET Nombre=?, Apellido=?, Dirección=?, Ciudad=?, Teléfono=?, Correo_electrónico=? WHERE ID_Cliente=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nombre, $apellido, $direccion, $ciudad, $telefono, $correo, $id_cliente);
    if($stmt->execute()){
        echo "Cliente actualizado con éxito.";
    } else {
        echo "Error al actualizar cliente: " . $conn->error;
    }
} else if ($action == "delete") {
    $id_cliente = $_POST["id_cliente"];
    checkEmptyFields(["id_cliente"]);
    
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

// Crear una lista de clientes.
$sql = "SELECT * FROM Clientes";
$result = $conn->query($sql);
$clientes = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
}

// Guardar la lista de clientes en una variable de sesión para su uso en registrocliente.html.
session_start();
$_SESSION['clientes'] = $clientes;
?>
