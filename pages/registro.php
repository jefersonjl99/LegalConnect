<?php
// Iniciar sesión
session_start();

// Definir variables e inicializarlas con valores vacíos
$nombre = $email = $telefono = $servicio = "";
$nombre_err = $email_err = $telefono_err = $servicio_err = "";

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar nombre
    if (empty(trim($_POST["nombre"]))) {
        $nombre_err = "Por favor ingrese su nombre completo.";
    } else {
        $nombre = trim($_POST["nombre"]);
    }

    // Validar correo electrónico
    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor ingrese su correo electrónico.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Por favor ingrese un correo electrónico válido.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validar teléfono
    if (empty(trim($_POST["telefono"]))) {
        $telefono_err = "Por favor ingrese su número de teléfono.";
    } else {
        $telefono = trim($_POST["telefono"]);
    }

    // Validar servicio
    if (empty($_POST["servicio"])) {
        $servicio_err = "Por favor seleccione un servicio.";
    } else {
        $servicio = $_POST["servicio"];
    }

    // Si no hay errores, mostrar el mensaje de éxito (simulación de inserción a base de datos)
    if (empty($nombre_err) && empty($email_err) && empty($telefono_err) && empty($servicio_err)) {


        $_SESSION["registro_exitoso"] = "¡Registro exitoso! Ahora puede acceder a nuestros servicios.";
        header("location: servicios.php");  // Redirigir a la página de servicios
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro | LegalConnect</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <!-- Header -->
    <?php include_once('../includes/header.php'); ?>

    <main>
        <section class="register-section">
            <div class="container">
                <h1>Registro de Usuario</h1>
                <p>Completa el siguiente formulario para registrarte y acceder a nuestros servicios legales.</p>

                <?php
                // Mostrar mensaje de éxito si el registro fue exitoso
                if (isset($_SESSION["registro_exitoso"])) {
                    echo '<div class="alert alert-success">' . $_SESSION["registro_exitoso"] . '</div>';
                    unset($_SESSION["registro_exitoso"]);
                }
                ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre Completo</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required placeholder="Ingrese su nombre completo">
                        <span class="error"><?php echo $nombre_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required placeholder="Ingrese su correo electrónico">
                        <span class="error"><?php echo $email_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Número de Teléfono</label>
                        <input type="tel" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required placeholder="Ingrese su número de teléfono">
                        <span class="error"><?php echo $telefono_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="servicio">Seleccione el Servicio</label>
                        <select id="servicio" name="servicio" required>
                            <option value="consultoria" <?php if ($servicio == "consultoria") echo "selected"; ?>>Consultoría Legal</option>
                            <option value="representacion" <?php if ($servicio == "representacion") echo "selected"; ?>>Representación Legal</option>
                            <option value="contratos" <?php if ($servicio == "contratos") echo "selected"; ?>>Redacción de Contratos</option>
                            <option value="laboral" <?php if ($servicio == "laboral") echo "selected"; ?>>Asesoría en Derecho Laboral</option>
                            <option value="familiar" <?php if ($servicio == "familiar") echo "selected"; ?>>Asesoría en Derecho Familiar</option>
                        </select>
                        <span class="error"><?php echo $servicio_err; ?></span>
                    </div>
                    <button type="submit" class="btn">Registrar</button>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include_once('../includes/footer.php'); ?>

</body>
</html>
