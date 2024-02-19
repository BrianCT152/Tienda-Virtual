<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Juguetes</title>
    <link rel="stylesheet" href="styles2.css"> 
</head>
<body>
<?php
// Verificar si se ha enviado el formulario de compra
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comprar'])) {
    // Verificar si se proporcionó el ID del juguete a comprar
    if (isset($_POST['id_juguete'])) {
        $juguetesId = $_POST['id_juguete'];

        // Conectar a la base de datos
        $servername = "localhost";
        $username = "admin";
        $password = "Oraclepass_123";
        $dbname = "alquiler_juguetes";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Verificar la conexión
        if (!$conn) {
            die("Error de conexión a la base de datos: " . mysqli_connect_error());
        }

        // Consulta SQL para eliminar el juguete de la base de datos
        $sqlEliminar = "DELETE FROM catalogo_juguetes WHERE id = $juguetesId";

        if (mysqli_query($conn, $sqlEliminar)) {
            // Mostrar mensaje de agradecimiento después de la compra
            echo "¡Gracias por tu compra! A continuación serás redirigido a una encuesta.";
            // Utilizar JavaScript para redirigir después de 5 segundos
            echo '<script>
                setTimeout(function() {
                    window.location.href = "https://forms.gle/Xju6yzXt6eGfC14u9";
                }, 5000);
            </script>';
        } else {
            // Mostrar mensaje de error si no se puede eliminar
            echo "Error al eliminar el juguete: " . mysqli_error($conn);
        }

        // Cerrar conexión
        mysqli_close($conn);
    }
}
?>
</body>
</html>

