<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] > 3) { // Todos los roles pueden editar clientes
    die("Acceso denegado.");
}

$conn = new mysqli("localhost", "root", "", "legal_connect");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del cliente
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM clients WHERE id = $id");

    if ($result->num_rows == 1) {
        $client = $result->fetch_assoc();
    } else {
        die("Cliente no encontrado.");
    }
}

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    $sql = "UPDATE clients SET name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $name, $email, $id);

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
    <title>Editar Cliente</title>
</head>
<body>
    <form action="edit_client.php?id=<?php echo $id; ?>" method="POST">
        <label>Nombre:</label>
        <input type="text" name="name" value="<?php echo $client['name']; ?>" required>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $client['email']; ?>" required>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
