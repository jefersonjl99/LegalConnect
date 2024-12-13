<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] > 2) { // Solo Administrador y Gerente pueden editar abogados
    die("Acceso denegado.");
}

$conn = new mysqli("localhost", "root", "", "legal_connect");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del abogado
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM lawyers WHERE id = $id");

    if ($result->num_rows == 1) {
        $lawyer = $result->fetch_assoc();
    } else {
        die("Abogado no encontrado.");
    }
}

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);

    $sql = "UPDATE lawyers SET name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $name, $id);

    if ($stmt->execute()) {
        header("location: administracion.php");
        exit;
    } else {
        echo "Error al actualizar.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Abogado</title>
</head>
<body>
    <form action="edit_lawyer.php?id=<?php echo $id; ?>" method="POST">
        <label>Nombre:</label>
        <input type="text" name="name" value="<?php echo $lawyer['name']; ?>" required>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
