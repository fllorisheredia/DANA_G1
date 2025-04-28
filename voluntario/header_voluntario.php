<?php
 //session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DANA - Tienda</title>

    <!-- DaisyUI + Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
</head>






<body class="min-h-screen flex flex-col font-[Raleway]">

    <div class="navbar bg-base-200 shadow-sm px-6 py-4">
        <div class="navbar-start">
            <a onclick="cargarVista('../voluntario/index_voluntario.php')"
                class="flex items-center gap-2 cursor-pointer">
                <img src="/DANA_G1/img/logoSinF.png" alt="Logo" class="w-auto sm:h-20">
                <span class="text-xl font-bold text-violet-700">Pueblo Unido</span>
            </a>
        </div>
        <div class="navbar-center">
            <ul class="menu menu-horizontal px-4 space-x-6">
                <li>
                    <button onclick="cargarVista('../voluntario/index_voluntario.php')"
                        class="btn bg-transparent text-md font-semibold text-base-content hover:bg-violet-700 hover:text-white transition-colors duration-300 border-none">
                        Inicio
                    </button>
                </li>
                <li>
                    <button onclick="cargarVista('../voluntario/subir_servicio.php')"
                        class="btn bg-transparent text-md font-semibold text-base-content hover:bg-violet-700 hover:text-white transition-colors duration-300 border-none">
                        Añadir Servicio
                    </button>
                </li>
                <li>
                    <button onclick="cargarVista('../voluntario/subir_producto.php')"
                        class="btn bg-transparent text-md font-semibold text-base-content hover:bg-violet-700 hover:text-white transition-colors duration-300 border-none">
                        Añadir Producto
                    </button>
                </li>
            </ul>
        </div>



        <div class="navbar-end gap-2">

            <div class="mr-10">
                <button class="btn btn-sm btn-outline" onclick="toggleTheme()">
                    <span id="theme-icon">🌙</span>
                </button>
            </div>

            <?php include 'deplegable_perfil.php' ?>

        </div>

    </div>
</body>

<script src="/DANA_G1/js/main.js"></script>