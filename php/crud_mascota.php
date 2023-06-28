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
}   else if ($action === 'get_owner') {
    $id_cliente_dueno = $_POST['id_cliente_dueno'];

    // Buscar los datos del dueño en la base de datos
    $sql = "SELECT * FROM Clientes WHERE ID_Cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_cliente_dueno]);

    if ($stmt->rowCount() > 0) {
        $owner = $stmt->fetch();
        // Mostrar los datos del dueño
        echo "ID del Cliente: " . $owner['ID_Cliente'] . "<br>";
        echo "Nombre: " . $owner['Nombre'] . "<br>";
        echo "Apellido: " . $owner['Apellido'] . "<br>";
        echo "Dirección: " . $owner['Dirección'] . "<br>";
        echo "Ciudad: " . $owner['Ciudad'] . "<br>";
        echo "Teléfono: " . $owner['Teléfono'] . "<br>";
        echo "Correo_electrónico: " . $owner['Correo_electrónico'] . "<br>";
    } else {
        echo "No se encontraron datos para el ID del cliente proporcionado.";
    }
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
