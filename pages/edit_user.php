<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1) {
    die("Acceso denegado.");
}

$conn = new mysqli("localhost", "root", "", "legal_connect");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del usuario
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM users WHERE id = $id");

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
    } else {
        die("Usuario no encontrado.");
    }
}

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role_id = intval($_POST['role_id']);

    $sql = "UPDATE users SET name = ?, email = ?, role_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $name, $email, $role_id, $id);

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
    <title>Editar Usuario</title>
</head>
<body>
    <form action="edit_user.php?id=<?php echo $id; ?>" method="POST">
        <label>Nombre:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        <label>Rol:</label>
        <select name="role_id" required>
            <option value="1" <?php if ($user['role_id'] == 1) echo "selected"; ?>>Administrador</option>
            <option value="2" <?php if ($user['role_id'] == 2) echo "selected"; ?>>Gerente</option>
            <option value="3" <?php if ($user['role_id'] == 3) echo "selected"; ?>>Asistente</option>
        </select>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
