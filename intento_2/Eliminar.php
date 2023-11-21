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

        // Preparar la consulta para eliminar el usuario con el ID proporcionado
        $consulta = $conexion->prepare("DELETE FROM usuario WHERE id = :usuario_id");
        $consulta->bindParam(':usuario_id', $usuario_id);
        
        // Ejecutar la consulta preparada
        $consulta->execute();
        
        // Redirigir a la página principal después de la eliminación
        header("Location: index.php");
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de usuario no proporcionado.";
}
?>
