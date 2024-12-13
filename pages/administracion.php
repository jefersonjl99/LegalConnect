<?php
include(__DIR__ . '/../includes/auth_check.php');

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "legal_connect");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener rol del usuario actual
$user_role = $_SESSION['user_role'];

// Obtener datos según permisos
$users = $user_role == 1 ? $conn->query("SELECT users.id, users.name, users.email, roles.name AS role FROM users INNER JOIN roles ON users.role_id = roles.id") : null;
$lawyers = $user_role <= 2 ? $conn->query("SELECT lawyers.id, lawyers.name, users.name AS created_by FROM lawyers LEFT JOIN users ON lawyers.created_by = users.id") : null;
$clients = $conn->query("SELECT clients.id, clients.name, clients.email, users.name AS created_by FROM clients LEFT JOIN users ON clients.created_by = users.id");

// Procesar formularios de creación
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_user']) && $user_role == 1) {
        // Crear usuario
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = md5(trim($_POST['password']));
        $role_id = intval($_POST['role_id']);

        $sql = "INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $email, $password, $role_id);
        $stmt->execute();
    }

    if (isset($_POST['create_lawyer']) && $user_role <= 2) {
        // Crear abogado
        $name = trim($_POST['name']);
        $created_by = $_SESSION['user_id'];

        $sql = "INSERT INTO lawyers (name, created_by) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $name, $created_by);
        $stmt->execute();
    }

    if (isset($_POST['create_client'])) {
        // Crear cliente
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $created_by = $_SESSION['user_id'];

        $sql = "INSERT INTO clients (name, email, created_by) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $email, $created_by);
        $stmt->execute();
    }

    // Redirigir para evitar reenvío de formularios
    header("location: administracion.php");
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración | LegalConnect</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <!-- Header -->
    <?php include('../includes/header.php'); ?>

    <main>
        <div class="container">
            <h1>Módulo de Administración</h1>

            <!-- Gestión de Usuarios -->
            <?php if ($user_role == 1): ?>
                <h2>Gestión de Usuarios</h2>
                <form method="POST" class="mb-4">
                    <input type="hidden" name="create_user">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Rol</label>
                        <select name="role_id" class="form-control" required>
                            <option value="1">Administrador</option>
                            <option value="2">Gerente</option>
                            <option value="3">Asistente</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Crear Usuario</button>
                </form>

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = $users->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $user['id']; ?></td>
                                <td><?php echo $user['name']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['role']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <!-- Gestión de Abogados -->
            <?php if ($user_role <= 2): ?>
                <h2>Gestión de Abogados</h2>
                <form method="POST" class="mb-4">
                    <input type="hidden" name="create_lawyer">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Crear Abogado</button>
                </form>

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Creado por</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($lawyer = $lawyers->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $lawyer['id']; ?></td>
                                <td><?php echo $lawyer['name']; ?></td>
                                <td><?php echo $lawyer['created_by']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <!-- Gestión de Clientes -->
            <h2>Gestión de Clientes</h2>
            <form method="POST" class="mb-4">
                <input type="hidden" name="create_client">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Crear Cliente</button>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Creado por</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($client = $clients->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $client['id']; ?></td>
                            <td><?php echo $client['name']; ?></td>
                            <td><?php echo $client['email']; ?></td>
                            <td><?php echo $client['created_by']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Footer -->
    <?php include('../includes/footer.php'); ?>
</body>
</html>
