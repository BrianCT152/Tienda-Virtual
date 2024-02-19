<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <h1>Lista de Usuarios</h1> 

    <?php
    session_start();

    $servername = "localhost";
    $username = "admin";
    $password = "Oraclepass_123";
    $dbname = "alquiler_juguetes";
    
    // Crear conexión
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Verificar la conexión
    if (!$conn) {
        die("Error de conexión a la base de datos: " . mysqli_connect_error());
    }

    // Consulta para obtener la lista de usuarios
    $sql = "SELECT id, nombre, apellidos, usuario, dni, email FROM Usuarios";
    $result = mysqli_query($conn, $sql);
     // Agregar el botón de redirección a administrador.php
     echo "<a href='administrador.php'><button type='button' class='btn'>Volver al Panel</button></a>";
    // Mostrar la lista de usuarios con botones de eliminación
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p>{$row['nombre']} {$row['apellidos']} (Usuario: {$row['usuario']}, DNI: {$row['dni']}, Email: {$row['email']}) ";
        }
    } else {
        echo "<p>No hay usuarios registrados.</p>";
    }

    // Cerrar la conexión
    mysqli_close($conn);
    ?>
</body>
</html>


