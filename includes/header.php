<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DANA - Tienda</title>
  <!-- Bootstrap 5 CSS -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- Bootstrap 5 Bundle JS (con Popper incluido) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="/DANA0/css/style.css">
</head>


<body class="min-h-screen flex flex-col font-[Raleway]">

    <div class="navbar bg-white shadow-sm px-6 py-4">
        <div class="navbar-start">
            <a href="/DANA/index.php" class="flex items-center gap-2">
                <img src="/DANA/img/logoSinF.png" alt="Logo" class="w-auto sm:h-20">
                <span class="text-xl font-bold text-violet-700">Pueblo Unido</span>
            </a>
        </div>

        <div class="navbar-center">
            <ul class="menu menu-horizontal px-4 space-x-6">
                <li><a href="/DANA/index.php" class="text-md text-black hover:bg-purple-600 font-semibold">Inicio</a>
                </li>
                <li><a href="/DANA/quienes_somos.php"
                        class="text-md text-black hover:bg-purple-600 font-semibold">Quiénes
                        Somos</a></li>
                <li><a href="contacto.php" class="text-md text-black hover:bg-purple-600 font-semibold">Contacto</a>
                </li>
            </ul>
        </div>

        <div class="navbar-end gap-2">
            <a href="/DANA/login.php" class="btn btn-outline btn-sm hover:bg-purple-600 text-black">Iniciar
                sesión</a>
            <a href="/DANA/registro.php"
                class="btn btn-sm bg-violet-700 hover:bg-violet-900 text-black">Registrarse</a>
        </div>

    </div>
</body>