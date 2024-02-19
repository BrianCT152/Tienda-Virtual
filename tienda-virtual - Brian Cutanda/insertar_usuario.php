<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Usuario</title>
    <link rel="stylesheet" type="text/css" href="styles2.css">
</head>
<body>
<?php
// Verificar si el usuario tiene permisos de administrador (sesion admin)
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $nombreUsuario = $_POST['usuario'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Aplicar hash a la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Consulta SQL para insertar el usuario en la base de datos
    $sqlInsertar = "INSERT INTO Usuarios (nombre, apellidos, usuario, dni, email, contraseña) 
                    VALUES ('$nombre', '$apellidos', '$nombreUsuario', '$dni', '$email', '$hashedPassword')";

    if (mysqli_query($conn, $sqlInsertar)) {
        echo "<body class='insertar-correctamente'>";
        echo "Usuario insertado correctamente.";
        echo "Redirigiendo al panel en 5 segundos.";
        header("refresh:5;url=administrador.php");
        exit();
    } else {
        echo "Error al insertar el usuario: " . mysqli_error($conn);
    }
}

// Cerrar conexión
mysqli_close($conn);
?>

 <!-- Formulario para que el administrador inserte -->
    <header>
        <h1>Insertar Usuario</h1>
    </header>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" required>
        </div>

        <div class="form-group">
            <label for="usuario">Nombre de Usuario:</label>
            <input type="text" name="usuario" required>
        </div>

        <div class="form-group">
            <label for="dni">DNI:</label>
            <input type="text" name="dni" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn">Insertar Usuario</button>
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
