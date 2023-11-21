
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<?php
// Aquí puedes manejar el formulario para crear un nuevo usuario
// Por ejemplo, recibir los datos del formulario y realizar la inserción en la base de datos

$host = 'localhost';
$dbname = 'crud';
$username = 'root';
$password = '';

// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];

    try {
        // Crear conexión PDO
        $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        // Configurar el modo de error de PDO a excepción
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar la consulta para insertar el nuevo usuario con los datos recibidos
        $consulta = $conexion->prepare("INSERT INTO usuario (Nombre, Apellido, Correo) VALUES (:nombre, :apellido, :correo)");
        
        // Ejecutar la consulta con los valores
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':apellido', $apellido);
        $consulta->bindParam(':correo', $correo);
        
        // Ejecutar la consulta preparada
        $consulta->execute();
        
        // Redirigir a la página principal después de la inserción
        header("Location: index.php");
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Si no se enviaron datos del formulario, mostrar el formulario para crear un nuevo usuario
    echo '<form method="post">';
    echo 'Nombre: <input type="text" name="nombre"><br>';
    echo 'Apellido: <input type="text" name="apellido"><br>';
    echo 'Correo: <input type="email" name="correo"><br>';
    echo '<input type="submit" value="Crear Usuario">';
    echo '</form>';
}
?>
