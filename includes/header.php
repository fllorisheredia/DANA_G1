<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DANA - Tienda</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
</head>


<body class="min-h-screen flex flex-col font-[Raleway]">

    <div class="navbar bg-white shadow-sm px-6 py-4">
        <div class="navbar-start">
            <a href="/DANA_G1/index.php" class="flex items-center gap-2">
                <img src="/DANA_G1/img/logoSinF.png" alt="Logo" class="w-auto sm:h-20">
                <span class="text-xl font-bold text-violet-700">Pueblo Unido</span>
            </a>
        </div>

        <div class="navbar-center">
            <ul class="menu menu-horizontal px-4 space-x-6">
                <li><a href="/DANA_G1/index.php" class="text-md text-black hover:bg-purple-600 font-semibold">Inicio</a>
                </li>
                <li><a href="/DANA_G1/quienes_somos.php"
                        class="text-md text-black hover:bg-purple-600 font-semibold">Quiénes
                        Somos</a></li>
                <li><a href="contacto.php" class="text-md text-black hover:bg-purple-600 font-semibold">Contacto</a>
                </li>
            </ul>
        </div>

        <div class="navbar-end gap-2">
            <a href="/DANA_G1/login.php" class="btn btn-outline btn-sm hover:bg-purple-600 text-black">Iniciar
                sesión</a>
            <a href="/DANA_G1/registro.php"
                class="btn btn-sm bg-violet-700 hover:bg-violet-900 text-black">Registrarse</a>
        </div>

    </div>
</body>