<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Datos</title>
</head>
<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0ffff;
            margin: 0;
            padding: 40px;
        }

        h1 {
            text-align: center;
            color: #008b8b; 
        }

        form {
            background: #ffffff;
            padding: 25px;
            width: 380px;
            margin: auto;
            border-radius: 15px;
            border: 2px solid #20b2aa;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #006f6f;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 2px solid #20b2aa;
            border-radius: 8px;
            outline: none;
        }

        input[type="submit"] {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            background-color: #20b2aa;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
        }
    </style>

    <h1>INSERTAR DATOS</h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="nombre">Nombre: </label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellido">Apellido: </label>
        <input type="text" id="apellido" name="apellido" required>

        <label for="nacimiento">Nacimiento: </label>
        <input type="text" id="nacimiento" name="nacimiento" required>

        <label for="especialidad">Especialidad: </label>
        <input type="text" id="especialidad" name="especialidad" required>

        <input type="submit" value="Agregar Registro">
    </form>

    <?php
    // Conexión a MySQL
    $conn = new mysqli("localhost", "root", "", "jailynbernal", 3307);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $nacimiento = $_POST['nacimiento'];
        $especialidad = $_POST['especialidad'];

        $sql = $conn->prepare("INSERT INTO cuchurrumaiso (nombre, apellido, nacimiento, especialidad) 
                               VALUES (?, ?, ?, ?)");
        $sql->bind_param("ssss", $nombre, $apellido, $nacimiento, $especialidad);

        if ($sql->execute()) {
            echo "<p style='color:green; text-align:center;'>registrate</p>";
        } else {
            echo "<p style='color:red; text-align:center;'>✘ Error: " . $sql->error . "</p>";
        }

        $sql->close();
    }

    $conn->close();
    ?>
</body>
</html>
