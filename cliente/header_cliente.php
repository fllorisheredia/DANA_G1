<?php
// session_start();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-zzzzzzzz8">
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
            <a onclick="cargarVista('../cliente/vistaInicio.php')" class="flex items-center gap-2">
                <img src="/DANA_G1/img/logoSinF.png" alt="Logo" class="w-auto sm:h-20">
                <span class="text-xl font-bold text-violet-700">Pueblo Unido</span>
            </a>
        </div>
        <div class="navbar-center">
            <ul class="menu menu-horizontal px-4 space-x-6">
                <li>
                    <button onclick="cargarVista('../cliente/vistaInicio.php')"
                        class="btn bg-transparent text-md font-semibold text-base-content hover:bg-violet-700 hover:text-white transition-colors duration-300 border-none">
                        Inicio
                    </button>
                </li>
                <li>
                    <button onclick="cargarVista('../cliente/paginaProductos.php')"
                        class="btn bg-transparent text-md font-semibold text-base-content hover:bg-violet-700 hover:text-white transition-colors duration-300 border-none">
                        Tienda Productos
                    </button>
                </li>
                <li>
                    <button onclick="cargarVista('../cliente/solicitarProducto.php')"
                        class="btn bg-transparent text-md font-semibold text-base-content hover:bg-violet-700 hover:text-white transition-colors duration-300 border-none">
                        Tienda Servicios
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
            <a href="/DANA_G1/carrito/index.php"
                class="flex items-center p-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg class="w-5 h-5 mx-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7 18C5.89543 18 5 18.8954 5 20C5 21.1046 5.89543 22 7 22C8.10457 22 9 21.1046 9 20C9 18.8954 8.10457 18 7 18Z"
                        fill="currentColor" />
                    <path
                        d="M17 18C15.8954 18 15 18.8954 15 20C15 21.1046 15.8954 22 17 22C18.1046 22 19 21.1046 19 20C19 18.8954 18.1046 18 17 18Z"
                        fill="currentColor" />
                    <path
                        d="M1 2H3L6.6 11.59L5.24 14.04C5.09 14.32 5 14.65 5 15C5 16.1046 5.89543 17 7 17H19V15H7.42C7.28 15 7.17 14.89 7.17 14.75L7.2 14.65L8.1 13H15.55C16.3 13 16.96 12.59 17.3 11.97L21.88 3.98C21.95 3.85 22 3.7 22 3.55C22 3.25 21.88 2.97 21.68 2.76C21.47 2.55 21.2 2.43 20.91 2.43H5.21L4.27 0H1V2Z"
                        fill="currentColor" />
                </svg>


                <span class="mx-1 font-bold text-base-content">
                    Carrito
                </span>
            </a>

            <?php include 'deplegable_perfil.php' ?>

            </a>
            
        </div>

    </div>
</body>






<script src="/DANA_G1/js/main.js"></script>