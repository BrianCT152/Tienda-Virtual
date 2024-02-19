<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Juguete</title>
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

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $imagen = mysqli_real_escape_string($conn, $_POST["imagen"]);
    $descripcion = mysqli_real_escape_string($conn, $_POST["descripcion"]);

    // Insertar juguete en la base de datos
    $sql = "INSERT INTO catalogo_juguetes (nombre, imagen, descripcion) VALUES ('$nombre', '$imagen', '$descripcion')";

    if (mysqli_query($conn, $sql)) {
        // Mostrar mensaje de éxito
        echo "Juguete insertado correctamente.";
    } else {
        // Mostrar mensaje de error
        echo "Error al insertar el juguete: " . mysqli_error($conn);
    }
}

// Cerrar conexión
mysqli_close($conn);
?>

    <header>
        <h1>Insertar Juguete</h1>
    </header>
    <!-- Formulario para insertar juguete -->
    <!-- special chars para convertir caracteres especiales en html  -->
    <!-- para asegurar que el contenido ingresado no se interpreta como HTML -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="nombre">Nombre del Juguete:</label>
            <input type="text" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="imagen">URL de la Imagen:</label>
            <input type="text" name="imagen" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn">Insertar Juguete</button>
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
