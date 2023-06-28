CREATE TABLE `Clientes` (
  `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellido` varchar(50) DEFAULT NULL,
  `Dirección` varchar(100) DEFAULT NULL,
  `Ciudad` varchar(50) DEFAULT NULL,
  `Teléfono` varchar(20) DEFAULT NULL,
  `Correo_electrónico` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_Cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Usuarios` (
  `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Usuario` varchar(50) DEFAULT NULL,
  `Contraseña` varchar(255) DEFAULT NULL,
  `Correo_electrónico` varchar(100) DEFAULT NULL,
  `Rol` enum('Usuario','Administrador') DEFAULT NULL,
  PRIMARY KEY (`ID_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Mascotas` (
  `ID_Mascota` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Cliente` int(11) DEFAULT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Especie` varchar(50) DEFAULT NULL,
  `Raza` varchar(50) DEFAULT NULL,
  `Fecha_Nacimiento` date DEFAULT NULL,
  `Peso` decimal(6,2) DEFAULT NULL,
  `Color` varchar(50) DEFAULT NULL,
  `Historial_Medico` text DEFAULT NULL,
  PRIMARY KEY (`ID_Mascota`),
  FOREIGN KEY (`ID_Cliente`) REFERENCES `Clientes` (`ID_Cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Inventario` (
  `ID_Producto` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `Descripción` text DEFAULT NULL,
  `Cantidad_Stock` int(11) DEFAULT NULL,
  `Proveedor` varchar(100) DEFAULT NULL,
  `Precio_Unitario` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`ID_Producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Citas` (
  `ID_Cita` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Mascota` int(11) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL,
  `Motivo` varchar(100) DEFAULT NULL,
  `Notas` text DEFAULT NULL,
  PRIMARY KEY (`ID_Cita`),
  FOREIGN KEY (`ID_Mascota`) REFERENCES `Mascotas` (`ID_Mascota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Tratamientos` (
  `ID_Tratamiento` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Mascota` int(11) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Descripción` text DEFAULT NULL,
  `Medicamento` varchar(100) DEFAULT NULL,
  `Dosis` varchar(50) DEFAULT NULL,
  `Duración` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Tratamiento`),
  FOREIGN KEY (`ID_Mascota`) REFERENCES `Mascotas` (`ID_Mascota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
