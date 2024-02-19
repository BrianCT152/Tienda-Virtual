<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Tienda de Juguetes</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>

<?php
$servername = "localhost";
$username = "admin";
$password = "Oraclepass_123";
$dbname = "alquiler_juguetes";

// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar la conexión
if (!$conn) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

// Obtener los datos del formulario mediante POST
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$usuario = $_POST['usuario'];
$dni = $_POST['dni'];
$email = $_POST['email'];
$contrasenya = $_POST['password'];

// Hash de la contraseña antes de almacenarla en la base de datos
// Esto es necesario, porque si lo meto como texto plano, el login no funciona.
$hashed_password = password_hash($contrasenya, PASSWORD_DEFAULT);

// Consulta SQL para insertar datos en la tabla Usuarios
$sql = "INSERT INTO Usuarios (nombre, apellidos, usuario, dni, email, contraseña) VALUES ('$nombre', '$apellidos', '$usuario', '$dni', '$email', '$hashed_password')";

// Ejecutar la consulta anterior
if (mysqli_query($conn, $sql)) {
    echo "Usuario registrado correctamente.";
    echo "Redirigiendo al panel en 5 segundos.";
// Redirigir a index después de 5 segundos
    header("refresh:5;url=index.html");
} else {
    echo "Error en la inserción de datos: " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>

<footer>
    <p>&copy; 2023 Tienda de Juguetes</p>
</footer>

</body>
</html>




