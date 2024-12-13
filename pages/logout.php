<?php
// logout.php
session_start();
session_unset(); // Eliminar todas las variables de sesión
session_destroy(); // Destruir la sesión
header("location: /LegalConnect/index.php");
exit;
?>