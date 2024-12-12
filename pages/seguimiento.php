<!-- Módulo Seguimiento -->

<?php
// Iniciar sesión para gestionar mensajes si es necesario
session_start();

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "legal_connect");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$searchResults = [];

if (isset($_GET['search'])) {
    $searchTerm = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT cases.id, cases.description, cases.status, clients.name AS client_name FROM cases 
            INNER JOIN clients ON cases.client_id = clients.id 
            WHERE cases.id LIKE '%$searchTerm%' OR cases.description LIKE '%$searchTerm%' OR clients.name LIKE '%$searchTerm%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento de Casos | LegalConnect</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <!-- Header -->
    <?php include('../includes/header.php'); ?>

    <main>
        <section class="tracking-section">
            <div class="container">
                <h1>Seguimiento de Casos</h1>
                <p>Ingrese el número o nombre del caso para verificar su estado:</p>

                <!-- Formulario de búsqueda -->
                <form method="GET" action="seguimiento.php" class="search-form">
                    <input type="text" name="search" placeholder="Buscar por ID, nombre de caso o cliente" required>
                    <button type="submit">Buscar</button>
                </form>

                <?php if (isset($_GET['search'])) : ?>
                    <h2>Resultados de la búsqueda:</h2>
                    <?php if (!empty($searchResults)) : ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID del Caso</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Cliente</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($searchResults as $case) : ?>
                                    <tr>
                                        <td><?php echo $case["id"]; ?></td>
                                        <td><?php echo $case["description"]; ?></td>
                                        <td><?php echo $case["status"]; ?></td>
                                        <td><?php echo $case["client_name"]; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p>No se encontraron casos que coincidan con su búsqueda.</p>
                    <?php endif; ?>
                <?php else : ?>
                    <p>Realice una búsqueda para ver los casos registrados.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include('../includes/footer.php'); ?>

</body>
</html>
