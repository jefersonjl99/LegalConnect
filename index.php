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
    <!-- <header>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="index.php" class="active">Inicio</a></li>
                    <li><a href="pages/servicios.php">Servicios</a></li>
                    <li><a href="pages/registro.php">Registro</a></li>
                    <li><a href="pages/seguimiento.php">Seguimiento</a></li>
                </ul>
            </nav>
        </div>
    </header> -->

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

        <!-- Seccion  Testimonios -->
        <section class="testimonials-section">
            <div class="container">
                <h2>Testimonios</h2>
                <div id="testimonialSlider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <p>"LegalConnect me ayudó a resolver mi problema legal rápidamente. ¡Muy profesionales!"</p>
                            <h5>- Juan Pérez</h5>
                        </div>
                        <div class="carousel-item">
                            <p>"Excelente servicio, muy recomendable para cualquier situación legal."</p>
                            <h5>- Ana Gómez</h5>
                        </div>
                        <div class="carousel-item">
                            <p>"La mejor asesoría que he recibido. Los recomiendo al 100%."</p>
                            <h5>- Carlos Díaz</h5>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#testimonialSlider" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#testimonialSlider" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include_once('includes/footer.php'); ?>

    <!-- Scripts -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
