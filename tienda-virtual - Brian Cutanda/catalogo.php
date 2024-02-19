<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Catálogo de Juguetes</title>
        <link rel="stylesheet" href="catalogo.css">
    </head>
    <body>
<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo "Hace falta iniciar sesión con un usuario válido";
} else {
    $servername = "localhost";
    $username = "admin";
    $password = "Oraclepass_123";
    $dbname = "alquiler_juguetes";

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Crear conexión
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Verificar la conexión
    if (!$conn) {
        die("Error de conexión a la base de datos: " . mysqli_connect_error());
    }

    // Consulta SQL para obtener los juguetes disponibles
    $sql = "SELECT * FROM catalogo_juguetes";
    $result = mysqli_query($conn, $sql);
    ?>


        <header>
            <h1>Catálogo de Juguetes</h1>
            <p>Explora nuestra increíble selección de juguetes.</p>
        </header>

        <?php
        // Verificar si el select anteriormente realizado devuelve al menos una fila de resultado
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='juguete'>";
                echo "<h2>" . $row['nombre'] . "</h2>";
                echo "<img src='" . $row['imagen'] . "' alt='" . $row['nombre'] . "'>";
                echo "<p>" . $row['descripcion'] . "</p>";

                // Formulario y botón de compra
                echo "<form method='post' action='comprar.php'>";
                echo "<input type='hidden' name='id_juguete' value='" . $row['id'] . "'>";
                echo "<button type='submit' name='comprar'>Comprar</button>";
                echo "</form>";

                echo "</div>";
            }
        } else {
            echo "<p>No hay juguetes disponibles en este momento.</p>";
        }

        // Cerrar la conexión
        mysqli_close($conn);
        ?>

        <footer>
            <p>&copy; 2023 Tienda de Juguetes</p>
        </footer>
    </body>
    </html>
<?php
}
?>




