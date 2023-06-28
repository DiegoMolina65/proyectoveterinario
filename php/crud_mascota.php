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
$id_cliente = $_POST["id_cliente"] ?? '';
$nombre = $_POST["nombre"] ?? '';
$especie = $_POST["especie"] ?? '';
$raza = $_POST["raza"] ?? '';
$fecha_nacimiento = $_POST["fecha_nacimiento"] ?? '';
$peso = $_POST["peso"] ?? '';
$color = $_POST["color"] ?? '';
$historial_medico = $_POST["historial_medico"] ?? '';

if ($action == "create") {
    checkEmptyFields(["id_cliente", "nombre", "especie", "raza", "fecha_nacimiento", "peso", "color", "historial_medico"]);
    
    $sql = "INSERT INTO Mascotas (ID_Cliente, Nombre, Especie, Raza, Fecha_Nacimiento, Peso, Color, Historial_Medico) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_cliente, $nombre, $especie, $raza, $fecha_nacimiento, $peso, $color, $historial_medico]);
    if($stmt->rowCount() > 0){
        echo "Mascota añadida con éxito.";
    } else {
        echo "Error al añadir mascota: " . $stmt->errorInfo()[2];
    }
} else if ($action == "update") {
    $id_mascota = $_POST["id_mascota"];
    checkEmptyFields(["id_mascota", "id_cliente", "nombre", "especie", "raza", "fecha_nacimiento", "peso", "color", "historial_medico"]);
    
    $sql = "UPDATE Mascotas SET ID_Cliente=?, Nombre=?, Especie=?, Raza=?, Fecha_Nacimiento=?, Peso=?, Color=?, Historial_Medico=? WHERE ID_Mascota=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_cliente, $nombre, $especie, $raza, $fecha_nacimiento, $peso, $color, $historial_medico, $id_mascota]);
    if($stmt->rowCount() > 0){
        echo "Mascota actualizada con éxito.";
    } else {
        echo "Error al actualizar mascota: " . $stmt->errorInfo()[2];
    }
} else if ($action == "delete") {
    $id_mascota = $_POST["id_mascota"];
    checkEmptyFields(["id_mascota"]);
    
    $sql = "DELETE FROM Mascotas WHERE ID_Mascota=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_mascota]);
    if($stmt->rowCount() > 0){
        echo "Mascota eliminada con éxito.";
    } else {
        echo "Error al eliminar mascota: " . $stmt->errorInfo()[2];
    }
}   else if ($action == "search") {
    $id_cliente = $_GET["id_cliente"];
    
    // Recupera la información del cliente
    $sql_cliente = "SELECT * FROM Clientes WHERE ID_Cliente = ?";
    $stmt_cliente = $conn->prepare($sql_cliente);
    $stmt_cliente->execute([$id_cliente]);
    $cliente = $stmt_cliente->fetch(PDO::FETCH_ASSOC);
    
    if ($cliente) {
        // Recupera las mascotas de este cliente
        $sql_mascotas = "SELECT * FROM Mascotas WHERE ID_Cliente = ?";
        $stmt_mascotas = $conn->prepare($sql_mascotas);
        $stmt_mascotas->execute([$id_cliente]);
        $mascotas = $stmt_mascotas->fetchAll(PDO::FETCH_ASSOC);
    
        // Guarda el cliente y sus mascotas en variables de sesión para su uso en la página de registro de mascotas
        session_start();
        $_SESSION['cliente'] = $cliente;
        $_SESSION['mascotas'] = $mascotas;
    } else {
        echo "No se encontró un cliente con el ID proporcionado.";
    }
    
    header('Location: ../html/registromascota.php');
    exit();
}


    

$stmt = null;
$conn = null;

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM Mascotas";
    $stmt = $conn->query($sql);
    $mascotas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Guardar la lista de mascotas en una variable de sesión para su uso en registro_mascotas.php.
    session_start();
    $_SESSION['mascotas'] = $mascotas;
} catch(PDOException $e) {
    echo "Error al recuperar la lista de mascotas: " . $e->getMessage();
}

?>
