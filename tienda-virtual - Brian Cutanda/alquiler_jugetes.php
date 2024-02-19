<?php
$servername = "localhost";
$username = "admin";
$password = "Oraclepass_123";

// Crear conexión
$conn = new mysqli($servername, $username, $password);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Crear la base de datos
$sql_create_db = "CREATE DATABASE IF NOT EXISTS alquiler_juguetes";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Base de datos alquiler_juguetes creada con éxito<br>";

    // Seleccionar la base de datos
    $conn->select_db("alquiler_juguetes");

    // Crear la tabla Usuarios
    $sql_create_table = "CREATE TABLE IF NOT EXISTS Usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        apellidos VARCHAR(50) NOT NULL,
        usuario VARCHAR(50) NOT NULL,
        dni VARCHAR(10) NOT NULL,
        email VARCHAR(50) NOT NULL,
        contraseña VARCHAR(255) NOT NULL
    )";
    
    if ($conn->query($sql_create_table) === TRUE) {
        echo "Tabla Usuarios creada con éxito<br>";
    } else {
        die("Error al crear la tabla Usuarios: " . $conn->error);
    }

    // Crear la tabla catalogo_juguetes
    $sql_create_table_catalogo = "CREATE TABLE IF NOT EXISTS catalogo_juguetes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        imagen VARCHAR(255) NOT NULL,
        descripcion TEXT NOT NULL
    )";
    
    if ($conn->query($sql_create_table_catalogo) === TRUE) {
        echo "Tabla catalogo_juguetes creada con éxito<br>";

        // Insertar juguete 1
        $sql_insert_toy1 = "INSERT INTO catalogo_juguetes (nombre, imagen, descripcion) VALUES ('Tractor Amarillo', 'https://media.dondinojuguetes.es/product/tractor-michigan-amarillo-33cm-800x800.jpg', '10€')";
        if ($conn->query($sql_insert_toy1) === TRUE) {
            echo "Juguete 1 insertado con éxito<br>";
        } else {
            die("Error al insertar el juguete 1: " . $conn->error);
        }

        // Insertar juguete 2
        $sql_insert_toy2 = "INSERT INTO catalogo_juguetes (nombre, imagen, descripcion) VALUES ('Tractor Rojo', 'https://m.media-amazon.com/images/I/81qZPXTONCL.jpg', '10€')";
        if ($conn->query($sql_insert_toy2) === TRUE) {
            echo "Juguete 2 insertado con éxito<br>";
        } else {
            die("Error al insertar el juguete 2: " . $conn->error);
        }
    } else {
        die("Error al crear la tabla catalogo_juguetes: " . $conn->error);
    }
} else {
    die("Error al crear la base de datos alquiler_juguetes: " . $conn->error);
}

// Cerrar conexión
$conn->close();
?>



