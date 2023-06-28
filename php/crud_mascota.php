<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "db_config.php";

$action = $_POST["action"];

if ($action == "create") {
    $id_cliente = $_POST["id_cliente"];
    $nombre = $_POST["nombre"];
    $especie = $_POST["especie"];
    $raza = $_POST["raza"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $peso = $_POST["peso"];
    $color = $_POST["color"];
    $historial_medico = $_POST["historial_medico"];

    $sql = "INSERT INTO Mascotas (ID_Cliente, Nombre, Especie, Raza, Fecha_Nacimiento, Peso, Color, Historial_Medico) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssss", $id_cliente, $nombre, $especie, $raza, $fecha_nacimiento, $peso, $color, $historial_medico);
    if($stmt->execute()){
        header("Location: registromascota.php");
        exit();
    } else {
        echo "Error al registrar mascota: " . $stmt->error;
    }
} elseif ($action == "get_owner") {
    $id_cliente_dueno = $_POST["id_cliente_dueno"];

    $sql = "SELECT * FROM Clientes WHERE ID_Cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_cliente_dueno);
    $stmt->execute();
    $result = $stmt->get_result();
    $cliente = $result->fetch_assoc();
    
    if ($cliente) {
        echo "<h3>Datos del Dueño</h3>";
        echo "<p>Nombre: " . $cliente['Nombre'] . "</p>";
        echo "<p>Apellido: " . $cliente['Apellido'] . "</p>";
        echo "<p>Dirección: " . $cliente['Dirección'] . "</p>";
        echo "<p>Ciudad: " . $cliente['Ciudad'] . "</p>";
        echo "<p>Teléfono: " . $cliente['Teléfono'] . "</p>";
        echo "<p>Correo Electrónico: " . $cliente['Correo_electrónico'] . "</p>";
    } else {
        echo "No se encontró un cliente con ese ID.";
    }
} elseif ($action == "update") {
    $id_mascota = $_POST["id_mascota"];
    $nombre = $_POST["nombre"];
    $especie = $_POST["especie"];
    $raza = $_POST["raza"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $peso = $_POST["peso"];
    $color = $_POST["color"];
    $historial_medico = $_POST["historial_medico"];

    $sql = "UPDATE Mascotas SET Nombre=?, Especie=?, Raza=?, Fecha_Nacimiento=?, Peso=?, Color=?, Historial_Medico=? WHERE ID_Mascota=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $nombre, $especie, $raza, $fecha_nacimiento, $peso, $color, $historial_medico, $id_mascota);
    if($stmt->execute()){
        header("Location: registromascota.php");
        exit();
    } else {
        echo "Error al actualizar mascota: " . $stmt->error;
    }
} elseif ($action == "delete") {
    $id_mascota = $_POST["id_mascota"];

    $sql = "DELETE FROM Mascotas WHERE ID_Mascota = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_mascota);
    if($stmt->execute()){
        header("Location: registromascota.php");
        exit();
    } else {
        echo "Error al eliminar mascota: " . $stmt->error;
    }
} else {
    echo "Acción no válida.";
}

$stmt->close();
$conn->close();
?>
