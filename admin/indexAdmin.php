<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>DANA - Administración</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="/DANA0/css/style.css">

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            background-color: #121212;
            color: white;
        }

        iframe {
            width: 100%;
            height: calc(100vh - 130px); /* Ajusta según el alto real de tu header */
            border: none;
            display: block;
        }

        .main-header {
            background-color: #f8f9fa;
            color: #212529;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .site-title {
            font-size: 1.5rem;
        }

        .highlight {
            color: #0d6efd;
        }

        .nav-link {
            font-weight: 500;
        }

        .nav-link:hover {
            color: #0d6efd;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            object-fit: cover;
            border-radius: 50%;
        }

        .dropdown .dropdown-menu {
            z-index: 1050;
        }
    </style>
</head>

<body>

    <header class="main-header">
         <h1 class="site-title m-0 px-4 pt-3">PUEBLO <span class="highlight">UNIDO</span></h1> 

        <div class="header-container container d-flex justify-content-between align-items-center pb-3" id="header-container">

            <nav class="main-nav d-flex gap-3 flex-wrap align-items-center">

                <a href="javascript:void(0);" class="nav-link" onclick="cargarPagina('../index.php')">🏠 Inicio</a>
                <a href="javascript:void(0);" class="nav-link" onclick="cargarPagina('cardAdminPanel.php')">📋 Panel Administración</a>
                <a href="javascript:void(0);" class="nav-link" onclick="cargarPagina('/DANA0/admin/usuariosAdmin.php')">👤 Gestionar Usuarios</a>
                <a href="javascript:void(0);" class="nav-link" onclick="cargarPagina('productosAdmin.php')">📦 Gestionar Productos</a>
                <a href="javascript:void(0);" class="nav-link" onclick="cargarPagina('pedidosAdmin.php')">🛒 Gestionar Pedidos</a>

                
            </nav>
            <!-- opcionesd el susario-->
            <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle pl-50 d-flex align-items-center gap-2" type="button"
                            id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/DANA0/imagenes/usuarios/<?php echo $_SESSION['foto_perfil'] ?? 'default.png'; ?>" 
                             alt="Perfil" class="user-avatar">
                        <?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Invitado'); ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Configuración</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="registro.php">Cerrar sesión</a></li>
                    </ul>
                </div>
        </div>
    </header>

    <iframe id="visor" src="cardAdminPanel.php"></iframe>

    <script>
        function cargarPagina(url) {
            const iframe = document.getElementById("visor");
            iframe.src = url;
        }
    </script>

</body>
</html>
