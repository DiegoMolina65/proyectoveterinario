<!DOCTYPE html>
<html>
<head>
    <title>Registro de Mascota</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/stylecrudmascota.css">
</head>
<body>
    <h2>Registrar Mascota</h2>
    <form action="../php/crud_mascota.php" method="post">
        <input type="hidden" name="action" value="create">
        <label for="id_cliente">ID del Cliente:</label><br>
        <input type="text" id="id_cliente" name="id_cliente"><br>
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre"><br>
        <label for="especie">Especie:</label><br>
        <input type="text" id="especie" name="especie"><br>
        <label for="raza">Raza:</label><br>
        <input type="text" id="raza" name="raza"><br>
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label><br>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"><br>
        <label for="peso">Peso:</label><br>
        <input type="text" id="peso" name="peso"><br>
        <label for="color">Color:</label><br>
        <input type="text" id="color" name="color"><br>
        <label for="historial_medico">Historial Médico:</label><br>
        <textarea id="historial_medico" name="historial_medico"></textarea><br>
        <input type="submit" value="Registrar">
    </form>

    <h2>Datos del Dueño</h2>
    <form action="../php/crud_mascota.php" method="post">
        <input type="hidden" name="action" value="get_owner">
        <label for="id_cliente_dueno">ID del Cliente:</label><br>
        <input type="text" id="id_cliente_dueno" name="id_cliente_dueno"><br>
        <input type="submit" value="Mostrar Datos del Dueño">
    </form>

 
    <h2>Tabla de Mascotas Registradas</h2>
    <table>
        <tr>
            <th>ID Mascota</th>
            <th>ID Cliente</th>
            <th>Nombre</th>
            <th>Especie</th>
            <th>Raza</th>
            <th>Fecha de Nacimiento</th>
            <th>Peso</th>
            <th>Color</th>
            <th>Historial Médico</th>
            <th>Acciones</th>
        </tr>
        
        <?php
        require_once "db_config.php";
        $sql = "SELECT * FROM Mascotas";
        $result = $conn->query($sql);

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
        ?>
    </table>
</body>
</html>
