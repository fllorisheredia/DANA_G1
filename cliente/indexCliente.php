<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-base-200 text-base-content min-h-screen flex flex-col font-[Raleway]">



    <!-- Contenido dinámico -->
    <main class="flex-grow p-4">
        <iframe id="iframeContenido" src="vistaInicio.php"
            class="w-full h-[85vh] rounded-lg border border-base-300 shadow" frameborder="0"></iframe>
    </main>


    <script>
    function cargarVista(pagina) {
        document.getElementById("iframeContenido").src = pagina;
    }

    function toggleTheme() {
        const html = document.documentElement;
        const icon = document.getElementById('theme-icon');
        if (html.getAttribute('data-theme') === 'dark') {
            html.setAttribute('data-theme', 'light');
            if (icon) icon.textContent = '🌙';
        } else {
            html.setAttribute('data-theme', 'dark');
            if (icon) icon.textContent = '☀️';
        }
    }
    </script>

</body>

</html>