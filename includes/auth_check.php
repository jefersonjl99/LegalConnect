<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])) {
    header("location: http://localhost/LegalConnect/pages/login.php");
    exit;
}
