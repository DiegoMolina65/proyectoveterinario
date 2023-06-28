<!DOCTYPE html>
<html>
<head>
    <title>Registro de Mascotas</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/stylecrudmascota.css">
</head>
<body>
    <h1>Registro de Mascotas</h1>
    <?php
        session_start();
        $mascotas = $_SESSION['mascotas'] ?? [];
    ?>

    <h2>Datos del Dueño</h2>
    <form action="../php/crud_mascota.php" method="post">
        <input type="hidden" name="action" value="get_owner">
        <label for="id_cliente_dueno">ID del Cliente:</label><br>
        <input type="text" id="id_cliente_dueno" name="id_cliente_dueno"><br>
        <input type="submit" value="Mostrar Datos del Dueño">
    </form>

    <h2>Registro mascota</h2>
    <form action="../php/crud_mascota.php" method="post">
        <input type="hidden" name="action" value="create">
        <label for="id_cliente">ID Cliente:</label><br>
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

    <h2>Lista de Mascotas</h2>
    <table>
        <tr>
            <th>ID Mascota</th>
            <th>ID Cliente</th>
            <th>Nombre</th>
            <th>Especie</th>
            <th>Raza</th>
            <th>Fecha Nacimiento</th>
            <th>Peso</th>
            <th>Color</th>
            <th>Historial Médico</th>
            <th>Acciones</th>
        </tr>
        <?php foreach($mascotas as $mascota): ?>
        <tr>
            <td><?php echo $mascota["ID_Mascota"]; ?></td>
            <td><?php echo $mascota["ID_Cliente"]; ?></td>
            <td><?php echo $mascota["Nombre"]; ?></td>
            <td><?php echo $mascota["Especie"]; ?></td>
            <td><?php echo $mascota["Raza"]; ?></td>
            <td><?php echo $mascota["Fecha_Nacimiento"]; ?></td>
            <td><?php echo $mascota["Peso"]; ?></td>
            <td><?php echo $mascota["Color"]; ?></td>
            <td><?php echo $mascota["Historial_Medico"]; ?></td>
            <td>
                <form action="../php/crud_mascota.php" method="post">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id_mascota" value="<?php echo $mascota["ID_Mascota"]; ?>">
                    <input type="text" name="id_cliente" value="<?php echo $mascota["ID_Cliente"]; ?>">
                    <input type="text" name="nombre" value="<?php echo $mascota["Nombre"]; ?>">
                    <input type="text" name="especie" value="<?php echo $mascota["Especie"]; ?>">
                    <input type="text" name="raza" value="<?php echo $mascota["Raza"]; ?>">
                    <input type="date" name="fecha_nacimiento" value="<?php echo $mascota["Fecha_Nacimiento"]; ?>">
                    <input type="text" name="peso" value="<?php echo $mascota["Peso"]; ?>">
                    <input type="text" name="color" value="<?php echo $mascota["Color"]; ?>">
                    <textarea name="historial_medico"><?php echo $mascota["Historial_Medico"]; ?></textarea>
                    <input type="submit" value="Actualizar">
                </form>
                <form action="../php/crud_mascota.php" method="post">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id_mascota" value="<?php echo $mascota["ID_Mascota"]; ?>">
                    <input type="submit" value="Eliminar">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
