<?php
// Iniciar sesión para gestionar mensajes si es necesario
session_start();

// Datos de casos simulados
$cases = [
    ["id" => 101, "title" => "Divorcio de mutuo acuerdo", "status" => "En Proceso"],
    ["id" => 102, "title" => "Disputa laboral", "status" => "Pendiente"],
    ["id" => 103, "title" => "Propiedad de bienes", "status" => "Finalizado"],
];

// Variable de resultados para almacenar casos filtrados
$searchResults = [];

// Comprobar si se ha realizado una búsqueda
if (isset($_GET['search'])) {
    $searchTerm = strtolower(trim($_GET['search']));
    foreach ($cases as $case) {
        // Filtrar por ID o título del caso (convertidos a minúsculas para coincidencia insensible a mayúsculas)
        if (strpos(strtolower($case["title"]), $searchTerm) !== false || strpos(strval($case["id"]), $searchTerm) !== false) {
            $searchResults[] = $case;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                    <input type="text" name="search" placeholder="Buscar por ID o nombre de caso" required>
                    <button type="submit">Buscar</button>
                </form>

                <?php if (isset($_GET['search'])) : ?>
                    <h2>Resultados de la búsqueda:</h2>
                    <?php if (!empty($searchResults)) : ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID del Caso</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($searchResults as $case) : ?>
                                    <tr>
                                        <td><?php echo $case["id"]; ?></td>
                                        <td><?php echo $case["title"]; ?></td>
                                        <td><?php echo $case["status"]; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p>No se encontraron casos que coincidan con su búsqueda.</p>
                    <?php endif; ?>
                <?php else : ?>
                    <h2>Casos Activos:</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID del Caso</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cases as $case) : ?>
                                <tr>
                                    <td><?php echo $case["id"]; ?></td>
                                    <td><?php echo $case["title"]; ?></td>
                                    <td><?php echo $case["status"]; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include('../includes/footer.php'); ?>

</body>
</html>
