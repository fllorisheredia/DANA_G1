<?php
include '../includes/db.php';
$paginaActual = basename($_SERVER['PHP_SELF']);
$resultado = $conexion->query("SELECT * FROM usuarios");
?>

<aside class="flex flex-col w-64 h-screen px-5 py-8 overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700">

    <a class="flex items-center gap-2">
        <img src="/DANA_G1/img/logoSinF.png" alt="Logo" class="w-auto sm:h-20">
        <h1 class="text-xl font-bold">PUEBLO <span class="text-violet-700">UNIDO</span></h1>
    </a>

    <div class="flex flex-col justify-between flex-1 mt-6">
        <nav class="flex-1 -mx-3 space-y-3 ">

            <a onclick="cargarPagina('cardAdminPanel.php')" href="javascript:void(0);"
                class="flex items-center px-3 py-2 text-white transition-colors duration-300 transform rounded-lg hover:bg-violet-700 <?php echo ($paginaActual === 'cardAdminPanel.php') ? 'bg-violet-700 font-bold' : ''; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                </svg>
                <span class="mx-2 text-sm font-medium">Panel Administración</span>
            </a>

            <a onclick="cargarPagina('usuariosAdmin.php')" href="javascript:void(0);"
                class="flex items-center px-3 py-2 text-white transition-colors duration-300 transform rounded-lg hover:bg-violet-700 <?php echo ($paginaActual === 'usuariosAdmin.php') ? 'bg-violet-700 font-bold' : ''; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                </svg>
                <span class="mx-2 text-sm font-medium">Usuarios</span>
            </a>

            <a onclick="cargarPagina('productosAdmin.php')" href="javascript:void(0);"
                class="flex items-center px-3 py-2 text-white transition-colors duration-300 transform rounded-lg hover:bg-violet-700 <?php echo ($paginaActual === 'productosAdmin.php') ? 'bg-violet-700 font-bold' : ''; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                </svg>
                <span class="mx-2 text-sm font-medium">Productos</span>
            </a>

            <a onclick="cargarPagina('pedidosAdmin.php')" href="javascript:void(0);"
                class="flex items-center px-3 py-2 text-white transition-colors duration-300 transform rounded-lg hover:bg-violet-700 <?php echo ($paginaActual === 'pedidosAdmin.php') ? 'bg-violet-700 font-bold' : ''; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6zM13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                </svg>
                <span class="mx-2 text-sm font-medium">Pedidos</span>
            </a>

            <a onclick="cargarPagina('serviciosAdmin.php')" href="javascript:void(0);"
                class="flex items-center px-3 py-2 text-white transition-colors duration-300 transform rounded-lg hover:bg-violet-700 <?php echo ($paginaActual === 'serviciosAdmin.php') ? 'bg-violet-700 font-bold' : ''; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6zM13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                </svg>
                <span class="mx-2 text-sm font-medium">Servicios</span>
            </a>

        </nav>



    
        <div class="mt-6 mb-10">
                <div class="p-3 bg-gray-100 rounded-lg dark:bg-gray-800">
                    <h2 class="text-sm font-medium text-gray-800 dark:text-white">Gracias Por tu <span class="text-purple-600">Colaboración!</span></h2>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Agradecemos sinceramente tu tiempo y esfuerzo...</p>
                    <img class="object-cover w-full h-32 mt-2 rounded-lg" src="../img/logoSinF.png" alt="">
                </div>




        <hr class="border-gray-200 dark:border-gray-700 ">


        <!-- Resto del aside intacto -->
        <div class="mr-10 mt-4">
            <button class="btn btn-sm btn-outline" onclick="toggleTheme()">
                <span id="theme-icon">🌙</span>
            </button>


                <div class="flex items-center justify-between mt-6">
                    <a href="#" class="flex items-center gap-x-2">
                    <!-- <img src="../<?php echo htmlspecialchars($_SESSION['foto_perfil']); ?>" alt="Foto Perfil" class="w-10 h-10 rounded-full mb-4"> -->

                        <?php echo htmlspecialchars($_SESSION['usuario']['nombre'] ?? 'Invitado'); ?>
                    </a>

                    <button id="btnCerrarSesion"
                        class="text-gray-500 transition-colors duration-200 rotate-180 dark:text-gray-400 rtl:rotate-0 hover:text-blue-500 dark:hover:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
</aside>

<script src="../js/main.js"></script>
<script>
document.getElementById('btnCerrarSesion').addEventListener('click', function () {
    fetch('../includes/cerrarSession.php')
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
            } else {
                window.location.href = '../index.php';
            }
        })
        .catch(error => {
            console.error('Error cerrando sesión:', error);
            alert("Hubo un error al cerrar la sesión.");
        });
});
</script>
