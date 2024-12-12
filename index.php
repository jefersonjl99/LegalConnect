<?php 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio | LegalConnect</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="js/script.js" defer></script>
</head>
<body>

    <!-- Header -->
    <?php include_once('includes/header.php'); ?>

    <main>
        <section class="hero-section">
            <div class="container text-center">
                <h1 class="display-4 animated fadeIn">Bienvenido a LegalConnect</h1>
                <p class="lead animated fadeIn">Tu socio confiable en servicios legales. Proporcionamos asesoría experta en diferentes áreas del derecho. Explora nuestros servicios y regístrate para comenzar.</p>

                <!-- Mensaje de sesión -->
                <?php
                if (isset($_SESSION["registro_exitoso"])) {
                    echo '<div class="alert alert-success animated fadeIn">' . $_SESSION["registro_exitoso"] . '</div>';
                    unset($_SESSION["registro_exitoso"]);
                }
                ?>

                <a href="pages/registro.php" class="btn btn-primary animated fadeIn">Regístrate Ahora</a>
            </div>
        </section>

        <!-- Seccion Mapa de Google -->
        <section class="map-section">
            <div class="container">
                <h2 class="text-center">Nuestra Ubicación</h2>
                <div id="map" style="width: 100%; height: 400px;"></div>
            </div>
        </section>

        <!-- Seccion  Servicios -->
        <section class="services-section text-center">
            <div class="container">
                <h2>Servicios Destacados</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="service-card">
                            <i class="fas fa-gavel"></i>
                            <h3>Asesoría Legal</h3>
                            <p>Recibe orientación experta para resolver tus problemas legales.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-card">
                            <i class="fas fa-users"></i>
                            <h3>Consultoría Corporativa</h3>
                            <p>Asesoría en el manejo de tu empresa y asuntos corporativos.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-card">
                            <i class="fas fa-heart"></i>
                            <h3>Derecho Familiar</h3>
                            <p>Asesoría en casos de familia, divorcios, herencias, etc.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <?php include_once('includes/footer.php'); ?>
    </main>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=initMap" async defer></script>
    <script>
        function initMap() {
            const bogota = { lat: 4.711, lng: -74.0721 };
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: bogota,
            });
            const marker = new google.maps.Marker({
                position: bogota,
                map: map,
            });
        }
    </script>
</body>
</html>
