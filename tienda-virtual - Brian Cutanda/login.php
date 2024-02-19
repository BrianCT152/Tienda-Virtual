<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - Tienda de Alquiler de Juguetes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
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

// Inicializar variables
$usuario = $contrasena = '';
$login_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta SQL para verificar el inicio de sesión
    $sql = "SELECT * FROM Usuarios WHERE usuario = '$usuario'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Si encuentra el usuario, verifica la contraseña
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            //password verify para que se almacene de manera segura usando password_hash
            if (password_verify($contrasena, $row['contraseña'])) {
                // Una vez la contraseña es verificada, inicia sesión exitosamente con el usuario.
                $_SESSION['usuario'] = $usuario;

                // Redirección según el usuario administrador o cualquiera
                if ($usuario == 'administrador') {
                    header("Location: administrador.php");
                    exit();
                } elseif ($usuario == 'otro_tipo_de_usuario') {
                    header("Location: catalogo.php");
                    exit();
                } else {
                    header("Location: catalogo.php");
                    exit();
                }
            } else {
                // Contraseña incorrecta a la insertada en base
                $login_error = "Nombre de usuario o contraseña incorrectos";
            }
        } else {
            // Usuario no encontrado en la base
            $login_error = "Nombre de usuario o contraseña incorrectos";
        }
    } else {
        // Error en la consulta
        $login_error = "Error en la consulta: " . mysqli_error($conn);
    }

    // Liberar el resultado
    mysqli_free_result($result);
}

// Cerrar conexión
mysqli_close($conn);
?>


    <header>
        <h1>Inicio de Sesión</h1>
    </header>

    <div class="mensaje-error">
        <?php
        echo $login_error;
        ?>
    </div>

    <div class="form-group">
        <a href="login.html">Volver al login</a>
    </div>

    <footer>
        <p>&copy; 2023 Tienda de Juguetes</p>
    </footer>
</body>
</html>

