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
    $stmt->execute([$nombre, $apellido, $direccion, $ciudad, $telefono, $correo]);
    if($stmt->rowCount() > 0){
        echo "Cliente añadido con éxito.";
    } else {
        echo "Error al añadir cliente: " . $stmt->errorInfo()[2];
    }
} else if ($action == "update") {
    $id_cliente = $_POST["id_cliente"];
    checkEmptyFields(["nombre", "apellido", "direccion", "ciudad", "telefono", "correo", "id_cliente"]);
    
    $sql = "UPDATE Clientes SET Nombre=?, Apellido=?, Dirección=?, Ciudad=?, Teléfono=?, Correo_electrónico=? WHERE ID_Cliente=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nombre, $apellido, $direccion, $ciudad, $telefono, $correo, $id_cliente]);
    if($stmt->rowCount() > 0){
        echo "Cliente actualizado con éxito.";
    } else {
        echo "Error al actualizar cliente: " . $stmt->errorInfo()[2];
    }
} else if ($action == "delete") {
    $id_cliente = $_POST["id_cliente"];
    checkEmptyFields(["id_cliente"]);
    
    $sql = "DELETE FROM Clientes WHERE ID_Cliente=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_cliente]);
    if($stmt->rowCount() > 0){
        echo "Cliente eliminado con éxito.";
    } else {
        echo "Error al eliminar cliente: " . $stmt->errorInfo()[2];
    }
}

$stmt = null;
$conn = null;

// Crear una lista de clientes.
try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM Clientes";
    $stmt = $conn->query($sql);
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Guardar la lista de clientes en una variable de sesión para su uso en registrocliente.php.
    session_start();
    $_SESSION['clientes'] = $clientes;
} catch(PDOException $e) {
    echo "Error al recuperar la lista de clientes: " . $e->getMessage();
}

?>
