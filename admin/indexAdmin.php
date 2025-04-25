<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>DANA - Administración</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />

    <style>
    iframe {
        width: 100%;
        height: calc(100vh - 64px);
        /* Resta el alto del header */
        border: none;
    }
    </style>



</head>

<body class="bg-white text-white">

    <div class="flex h-screen">

        <!-- Sidebar (izquierda) -->
        <aside class="w-64 bg-base-100 text-white  flex flex-col">
            <?php include 'navbarAdmin.php'; ?>
        </aside>

        <!-- Contenido principal  -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Área del iframe -->
            <main class=" bg-base-100 flex-1 overflow-auto">
                <iframe id="visor" src="cardAdminPanel.php"></iframe>
            </main>
        </div>
    </div>
    <!-- <?php include '../includes/footer.php'?> -->

    <script>
    function cargarPagina(url) {
        document.getElementById("visor").src = url;
    }
    </script>

</body>

</html>