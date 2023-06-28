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
    $stmt->execute([$id_cliente, $nombre, $especie, $raza, $fecha_nacimiento, $peso, $color, $historial_medico]);
    if($stmt->rowCount() > 0){
        header("Location: ../html/registromascota.php");
        exit();
    } else {
        echo "Error al registrar mascota: " . $stmt->errorInfo()[2];
    }
} elseif ($action == "get_owner") {
    $id_cliente_dueno = $_POST["id_cliente_dueno"];

    $sql = "SELECT * FROM Clientes WHERE ID_Cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_cliente_dueno]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    
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
    $stmt->execute([$nombre, $especie, $raza, $fecha_nacimiento, $peso, $color, $historial_medico, $id_mascota]);
    if($stmt->rowCount() > 0){
        header("Location: ../html/registromascota.php");
        exit();
    } else {
        echo "Error al actualizar mascota: " . $stmt->errorInfo()[2];
    }
} elseif ($action == "delete") {
    $id_mascota = $_POST["id_mascota"];

    $sql = "DELETE FROM Mascotas WHERE ID_Mascota = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_mascota]);
    if($stmt->rowCount() > 0){
        header("Location: ../html/registromascota.php");
        exit();
    } else {
        echo "Error al eliminar mascota: " . $stmt->errorInfo()[2];
    }
} else {
    echo "Acción no válida.";
}

$conn = null;
?>
