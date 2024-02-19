<?php
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'administrador') {
    echo "Acceso no autorizado";
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="styles3.css">
</head>
<body>
    <header>
        <h1>Panel de Administrador</h1>
    </header>

    <nav>
        <ul>
            <li><a href="insertar_usuario.php" class="btn">Insertar Usuarios</a></li>
            <li><a href="eliminar_usuario.php" class="btn">Eliminar Usuarios</a></li>
            <li><a href="insertar_juguete.php" class="btn">Insertar Juguetes</a></li>
            <li><a href="consultas.php" class="btn">Consultas</a></li>
        </ul>
    </nav>

    <footer>
        <p>&copy; 2023 Tienda de Juguetes</p>
    </footer>
</body>
</html>
