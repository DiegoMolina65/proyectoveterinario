<!DOCTYPE html>
<html>
<head>
    <title>Registro de Cliente</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/stylescrudcliente.css">
</head>
<body>
    <h1>Registro de Cliente</h1>
    <?php
        session_start();
        $clientes = $_SESSION['clientes'] ?? [];
    ?>

    <form action="../php/crud_clientes.php" method="post">
        <input type="hidden" name="action" value="create">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre"><br>
        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido"><br>
        <label for="direccion">Dirección:</label><br>
        <input type="text" id="direccion" name="direccion"><br>
        <label for="ciudad">Ciudad:</label><br>
        <input type="text" id="ciudad" name="ciudad"><br>
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono"><br>
        <label for="correo">Correo Electrónico:</label><br>
        <input type="text" id="correo" name="correo"><br>
        <input type="submit" value="Registrar">
    </form>

    <h2>Lista de Clientes</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Dirección</th>
            <th>Ciudad</th>
            <th>Teléfono</th>
            <th>Correo Electrónico</th>
            <th>Acciones</th>
        </tr>
        <?php foreach($clientes as $cliente): ?>
        <tr>
            <td><?php echo $cliente["ID_Cliente"]; ?></td>
            <td><?php echo $cliente["Nombre"]; ?></td>
            <td><?php echo $cliente["Apellido"]; ?></td>
            <td><?php echo $cliente["Dirección"]; ?></td>
            <td><?php echo $cliente["Ciudad"]; ?></td>
            <td><?php echo $cliente["Teléfono"]; ?></td>
            <td><?php echo $cliente["Correo_electrónico"]; ?></td>
            <td>
                <form action="../php/crud_clientes.php" method="post">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id_cliente" value="<?php echo $cliente["ID_Cliente"]; ?>">
                    <input type="text" name="nombre" value="<?php echo $cliente["Nombre"]; ?>">
                    <input type="text" name="apellido" value="<?php echo $cliente["Apellido"]; ?>">
                    <input type="text" name="direccion" value="<?php echo $cliente["Dirección"]; ?>">
                    <input type="text" name="ciudad" value="<?php echo $cliente["Ciudad"]; ?>">
                    <input type="text" name="telefono" value="<?php echo $cliente["Teléfono"]; ?>">
                    <input type="text" name="correo" value="<?php echo $cliente["Correo_electrónico"]; ?>">
                    <input type="submit" value="Actualizar">
                </form>
                <form action="../php/crud_clientes.php" method="post">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id_cliente" value="<?php echo $cliente["ID_Cliente"]; ?>">
                    <input type="submit" value="Eliminar">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
