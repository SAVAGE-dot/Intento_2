<!DOCTYPE html>
<html>
<head>
    <title>CRUD de Usuarios</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head class="p-3 mb-2 bg-black text-white">
<body class="p-3 mb-2 bg-black text-white">
    <p>CRUD de Usuarios</p>
    
    <?php
    // Datos de conexión a la base de datos
    $host = 'localhost';
    $dbname = 'crud';
    $username = 'root';
    $password = '';

    try {
        // Crear conexión PDO
        $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        // Configurar el modo de error de PDO a excepción
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Consulta para obtener todos los usuarios
        $consulta = $conexion->query("SELECT * FROM usuario");
        
        // Mostrar los usuarios en una tabla HTML
        echo '<table border="1" class="table table-bordered">';
        echo '<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Correo</th><th>Acciones</th></tr>';
        
        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $fila['id'] . '</td>';
            
            echo '<td>' . (isset($fila['nombre']) ? $fila['nombre'] : '') . '</td>';
            echo '<td>' . (isset($fila['apellido']) ? $fila['apellido'] : '') . '</td>';
            echo '<td>' . (isset($fila['correo']) ? $fila['correo'] : '') . '</td>';
            
            echo '<td>';
            echo '<a href="editar.php?id=' . $fila['id'] . '" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Editar</a> | ';
            echo '<a href="eliminar.php?id=' . $fila['id'] . '" class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Eliminar</a>';
            echo '</td>';
            echo '</tr>';

                    
        }
        
        echo '</table>';
    } catch(PDOException $e) {
        // Mostrar cualquier error de conexión
        echo "Error al conectar a la base de datos: " . $e->getMessage();
    }
    ?>

    <br>
    <a href="crear.php" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Crear Nuevo Usuario</a>
</body>
</html>
