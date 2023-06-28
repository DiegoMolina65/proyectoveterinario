<?php
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

    if ($stmt->execute()) {
        echo "La mascota se registró exitosamente.";
    } else {
        echo "Error al registrar la mascota: " . $stmt->error;
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
} elseif ($action == "delete") {
    $id_mascota = $_POST["id_mascota"];

    $sql = "DELETE FROM Mascotas WHERE ID_Mascota = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_mascota);

    if ($stmt->execute()) {
        echo "La mascota se eliminó exitosamente.";
    } else {
        echo "Error al eliminar la mascota: " . $stmt->error;
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

    $sql = "UPDATE Mascotas SET Nombre = ?, Especie = ?, Raza = ?, Fecha_Nacimiento = ?, Peso = ?, Color = ?, Historial_Medico = ? WHERE ID_Mascota = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $nombre, $especie, $raza, $fecha_nacimiento, $peso, $color, $historial_medico, $id_mascota);

    if ($stmt->execute()) {
        echo "La mascota se actualizó exitosamente.";
    } else {
        echo "Error al actualizar la mascota: " . $stmt->error;
    }
}

// Obtener y mostrar las mascotas registradas en una tabla
$sql = "SELECT * FROM Mascotas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Tabla de Mascotas Registradas</h2>";
    echo "<table>";
    echo "<tr>";
    echo "<th>ID Mascota</th>";
    echo "<th>ID Cliente</th>";
    echo "<th>Nombre</th>";
    echo "<th>Especie</th>";
    echo "<th>Raza</th>";
    echo "<th>Fecha de Nacimiento</th>";
    echo "<th>Peso</th>";
    echo "<th>Color</th>";
    echo "<th>Historial Médico</th>";
    echo "<th>Acciones</th>";
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['ID_Mascota'] . "</td>";
        echo "<td>" . $row['ID_Cliente'] . "</td>";
        echo "<td>" . $row['Nombre'] . "</td>";
        echo "<td>" . $row['Especie'] . "</td>";
        echo "<td>" . $row['Raza'] . "</td>";
        echo "<td>" . $row['Fecha_Nacimiento'] . "</td>";
        echo "<td>" . $row['Peso'] . "</td>";
        echo "<td>" . $row['Color'] . "</td>";
        echo "<td>" . $row['Historial_Medico'] . "</td>";
        echo "<td>";
        echo "<form action='../php/crud_mascota.php' method='post'>";
        echo "<input type='hidden' name='action' value='delete'>";
        echo "<input type='hidden' name='id_mascota' value='" . $row['ID_Mascota'] . "'>";
        echo "<button type='submit'>Eliminar</button>";
        echo "</form>";
        echo "<form action='../php/crud_mascota.php' method='post'>";
        echo "<input type='hidden' name='action' value='update'>";
        echo "<input type='hidden' name='id_mascota' value='" . $row['ID_Mascota'] . "'>";
        echo "<button type='submit'>Actualizar</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron mascotas registradas.";
}

$stmt->close();
$conn->close();
?>
