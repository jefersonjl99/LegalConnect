<header> 
    <div class="container">
        <nav>
            <ul class="nav">
                <li class="nav-item"><a href="/LegalConnect/index.php" class="nav-link">Inicio</a></li>
                <li class="nav-item"><a href="/LegalConnect/pages/servicios.php" class="nav-link">Servicios</a></li>
                <li class="nav-item"><a href="/LegalConnect/pages/registro.php" class="nav-link">Registro</a></li>
                <li class="nav-item"><a href="/LegalConnect/pages/seguimiento.php" class="nav-link">Seguimiento</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a href="/LegalConnect/pages/administracion.php" class="nav-link">Administración</a></li>
                <?php endif; ?>
                <li class="nav-item">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form action="/LegalConnect/pages/logout.php" method="POST" style="display:inline;">
                            <button type="submit" class="btn nav-link">Cerrar Sesión</button>
                        </form>
                    <?php else: ?>
                        <button id="loginButton" class="btn nav-link">Iniciar Sesión</button>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
        <div class="login-container" id="loginModal" style="display: none;">
            <form action="/LegalConnect/pages/login.php" method="POST">
                <h3>Iniciar Sesión</h3>
                <input type="email" name="email" placeholder="Correo Electrónico" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Iniciar Sesión</button>
                <button type="button" id="closeLogin" class="btn">Cerrar</button>
            </form>
        </div>
    </div>
</header>

<script>
    // Mostrar y ocultar el modal de inicio de sesión
    document.getElementById('loginButton').addEventListener('click', function() {
        document.getElementById('loginModal').style.display = 'block';
    });

    document.getElementById('closeLogin').addEventListener('click', function() {
        document.getElementById('loginModal').style.display = 'none';
    });
</script>
