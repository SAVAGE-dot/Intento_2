<?php
$host = 'localhost';
$dbname = 'crud';
$username = 'root';
$password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];

    try {
        $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $conexion->prepare("UPDATE usuario SET Nombre = :nombre, Apellido = :apellido, Correo = :correo WHERE id = :usuario_id");
        $consulta->bindParam(':usuario_id', $usuario_id);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':apellido', $apellido);
        $consulta->bindParam(':correo', $correo);
        
        $consulta->execute();

        header("Location: index.php");
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Error al procesar la solicitud.";
}
?>
