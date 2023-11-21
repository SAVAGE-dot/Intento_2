<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<?php
$host = 'localhost';
$dbname = 'crud';
$username = 'root';
$password = '';

// Verificar si se recibió un ID válido en la URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $usuario_id = $_GET['id'];

    try {
        // Crear conexión PDO
        $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        // Configurar el modo de error de PDO a excepción
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar y ejecutar consulta para obtener los datos del usuario con el ID proporcionado
        $consulta = $conexion->prepare("SELECT * FROM usuario WHERE id = :usuario_id");
        $consulta->bindParam(':usuario_id', $usuario_id);
        $consulta->execute();
        
        // Obtener los datos del usuario
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario) {
            // Mostrar formulario con los datos del usuario para editarlos
            echo '<form method="post" action="Actualizar.php">';
            echo '<input type="hidden" name="id" value="' . $usuario['id'] . '">';
            echo 'Nombre: <input type="text" name="nombre" value="' . $usuario['nombre'] . '"><br>';
            echo 'Apellido: <input type="text" name="apellido" value="' . $usuario['apellido'] . '"><br>';
            echo 'Correo: <input type="email" name="correo" value="' . $usuario['correo'] . '"><br>';
            echo '<input type="submit" value="Actualizar">';
            echo '</form>';
        } else {
            echo "No se encontró el usuario con el ID proporcionado.";
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de usuario no proporcionado.";
}
?>
