<?php

if ($conn->query($sql) === TRUE) {
    // La consulta se ejecutó correctamente
} else {
    echo 'Error al ejecutar la consulta: ' . $conn->error;
}

// Importar el archivo de configuración de la base de datos (db_config.php)
require_once 'db_config.php';

// Verificar si se envió el formulario de registro de mascotas
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    // Verificar si la acción es "create" (registro de mascota)
    if ($action === 'create') {
        // Recuperar los datos del formulario
        $id_cliente = $_POST['id_cliente'];
        $nombre = $_POST['nombre'];
        $especie = $_POST['especie'];
        $raza = $_POST['raza'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $peso = $_POST['peso'];
        $color = $_POST['color'];
        $historial_medico = $_POST['historial_medico'];

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO Mascotas (ID_Cliente, Nombre, Especie, Raza, Fecha_Nacimiento, Peso, Color, Historial_Medico)
                VALUES ('$id_cliente', '$nombre', '$especie', '$raza', '$fecha_nacimiento', '$peso', '$color', '$historial_medico')";
        
        if ($conn->query($sql) === TRUE) {
            // Redireccionar a la página actual para actualizar la tabla de mascotas registradas
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo 'Error al insertar los datos: ' . $conn->error;
        }
    }

    // Verificar si la acción es "update" (edición de mascota)
    if ($action === 'update') {
        $id_mascota = $_POST['id_mascota'];
        // Recuperar los datos actualizados del formulario
        $nombre = $_POST['nombre'];
        $especie = $_POST['especie'];
        $raza = $_POST['raza'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $peso = $_POST['peso'];
        $color = $_POST['color'];
        $historial_medico = $_POST['historial_medico'];

        // Actualizar los datos en la base de datos
        $sql = "UPDATE Mascotas SET 
                    Nombre = '$nombre',
                    Especie = '$especie',
                    Raza = '$raza',
                    Fecha_Nacimiento = '$fecha_nacimiento',
                    Peso = '$peso',
                    Color = '$color',
                    Historial_Medico = '$historial_medico'
                WHERE ID_Mascota = $id_mascota";

        if ($conn->query($sql) === TRUE) {
            // Redireccionar a la página actual para actualizar la tabla de mascotas registradas
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo 'Error al actualizar los datos: ' . $conn->error;
        }
    }

    // Verificar si la acción es "delete" (eliminación de mascota)
    if ($action === 'delete') {
        $id_mascota = $_POST['id_mascota'];

        // Eliminar la mascota de la base de datos
        $sql = "DELETE FROM Mascotas WHERE ID_Mascota = $id_mascota";

        if ($conn->query($sql) === TRUE) {
            // Redireccionar a la página actual para actualizar la tabla de mascotas registradas
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo 'Error al eliminar los datos: ' . $conn->error;
        }
    }

    // Verificar si la acción es "get_owner" (obtener datos del dueño)
    if ($action === 'get_owner') {
        $id_cliente_dueno = $_POST['id_cliente_dueno'];

        // Buscar los datos del dueño en la base de datos
        $sql = "SELECT * FROM Clientes WHERE ID_Cliente = $id_cliente_dueno";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $owner = $result->fetch_assoc();
            // Mostrar los datos del dueño
            echo "ID del Cliente: " . $owner['ID_Cliente'] . "<br>";
            echo "Nombre: " . $owner['Nombre'] . "<br>";
            echo "Apellido: " . $owner['Apellido'] . "<br>";
            // Agrega más campos según la estructura de tu tabla "Clientes"
        } else {
            echo "No se encontraron datos para el ID del cliente proporcionado.";
        }
    }
}
?>
