<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
// Verificar si el usuario tiene permisos de administrador
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'administrador') {
    header("Location: login_admin.php");
    exit();
}

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

// Obtener la lista de usuarios (reemplaza con la consulta SQL)
$sql = "SELECT id, usuario FROM Usuarios";
$result = mysqli_query($conn, $sql);
?>


    <header>
        <h1>Eliminar Usuario</h1>
    </header>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="usuario">Selecciona el usuario a eliminar:</label>
            <select name="usuario" required>
                <?php
                // Reiniciar el puntero del conjunto de resultados
                mysqli_data_seek($result, 0);

                // Recorrer el conjunto de resultados y mostrar opciones
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['usuario'] . "'>" . $row['usuario'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn">Eliminar Usuario</button>
        </div>

        <div class="form-group">
        <a href="administrador.php" class="btn">Volver al panel</a>
        </div>
    </form>

    <footer>
        <p>&copy; 2023 Tienda de Juguetes</p>
    </footer>
</body>
</html>

<?php

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre del usuario a eliminar
    $nombreUsuario = mysqli_real_escape_string($conn, $_POST['usuario']);

    // Eliminar el usuario de la base de datos (reemplazar con la consulta SQL)
    $sqlEliminar = "DELETE FROM Usuarios WHERE usuario = '$nombreUsuario'";
    if (mysqli_query($conn, $sqlEliminar)) {
        echo "Usuario eliminado correctamente.";

        // Redirigir a la misma página después de la eliminación
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error al eliminar el usuario: " . mysqli_error($conn);
    }

    // Cerrar conexión
    mysqli_close($conn);
}
?>


