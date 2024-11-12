<?php 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Servicios | LegalConnect</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="../js/script.js"></script> <!-- Agregamos el JS para interactividad -->
</head>
<body>

    <!-- Header -->
    <?php include_once('../includes/header.php'); ?>

    <main>
        <section class="services-section">
            <div class="container">
                <h2 class="text-center">Nuestros Servicios Legales</h2>
                <p class="text-center">Ofrecemos una amplia gama de servicios para cubrir todas tus necesidades legales.</p>

                <div class="row">
                    <!-- Servicio 1 -->
                    <div class="col-md-4 service-card">
                        <div class="card">
                            <img src="../images/servicio1.jpg" class="card-img-top" alt="Servicio 1">
                            <div class="card-body">
                                <h5 class="card-title">Asesoría Jurídica</h5>
                                <p class="card-text">Brindamos orientación en temas legales complejos para asegurarnos de que tomes decisiones informadas.</p>
                                <a href="registro.php" class="btn btn-primary">Solicitar Asesoría</a>
                            </div>
                        </div>
                    </div>

                    <!-- Servicio 2 -->
                    <div class="col-md-4 service-card">
                        <div class="card">
                            <img src="../images/servicio2.jpg" class="card-img-top" alt="Servicio 2">
                            <div class="card-body">
                                <h5 class="card-title">Defensa Penal</h5>
                                <p class="card-text">Nuestro equipo de expertos está listo para defenderte en casos penales, protegiendo tus derechos.</p>
                                <a href="registro.php" class="btn btn-primary">Solicitar Defensa</a>
                            </div>
                        </div>
                    </div>

                    <!-- Servicio 3 -->
                    <div class="col-md-4 service-card">
                        <div class="card">
                            <img src="../images/servicio3.jpg" class="card-img-top" alt="Servicio 3">
                            <div class="card-body">
                                <h5 class="card-title">Asesoría en Contratos</h5>
                                <p class="card-text">Nos especializamos en la redacción y revisión de contratos para evitar futuros conflictos legales.</p>
                                <a href="registro.php" class="btn btn-primary">Obtener Asesoría</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include_once('../includes/footer.php'); ?>

</body>
</html>
