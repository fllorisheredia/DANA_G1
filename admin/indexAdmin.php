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

    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="/DANA0/css/style.css">

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            background-color: #121212;
            color: white;
        }

        iframe {
            width: 100%;
            height: calc(100vh - 130px);
            /* Ajusta según el alto real de tu header */
            border: none;
            display: block;
        }

        .main-header {
            background-color: #f8f9fa;
            color: #212529;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
    </style>
</head>

<body>

    <!-- HEADER PERSONALIZADO -->
    <header class="main-header">
        <h1 class="site-title m-0 px-4 pt-3">PUEBLO <span class="highlight">UNIDO</span></h1>

        <div class="header-container container d-flex justify-content-between align-items-center pb-3" id="visor">
            <nav class="main-nav d-flex gap-3 flex-wrap">
                <a href="../index.php" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <defs>
                            <path id="solarHomeBoldDuotone0"
                                d="M10.75 9.5a1.25 1.25 0 1 1 2.5 0a1.25 1.25 0 0 1-2.5 0" />
                        </defs>
                        <path fill="currentColor" fill-rule="evenodd"
                            d="m21.532 11.586l-.782-.626v10.29H22a.75.75 0 0 1 0 1.5H2a.75.75 0 1 1 0-1.5h1.25V10.96l-.781.626a.75.75 0 1 1-.937-1.172l8.125-6.5a3.75 3.75 0 0 1 4.686 0l8.125 6.5a.75.75 0 1 1-.936 1.172M12 6.75a2.75 2.75 0 1 0 0 5.5a2.75 2.75 0 0 0 0-5.5m1.746 6.562c-.459-.062-1.032-.062-1.697-.062h-.098c-.665 0-1.238 0-1.697.062c-.491.066-.963.215-1.345.597s-.531.854-.597 1.345c-.062.459-.062 1.032-.062 1.697v4.299h7.5v-4.423c0-.612-.004-1.143-.062-1.573c-.066-.491-.215-.963-.597-1.345s-.853-.531-1.345-.597"
                            clip-rule="evenodd" />
                        <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" opacity="0.5">
                            <use href="#solarHomeBoldDuotone0" />
                            <use href="#solarHomeBoldDuotone0" />
                        </g>
                        <path fill="currentColor"
                            d="M12.05 13.25c.664 0 1.237 0 1.696.062c.492.066.963.215 1.345.597s.531.853.597 1.345c.058.43.062.96.062 1.573v4.423h-7.5v-4.3c0-.664 0-1.237.062-1.696c.066-.492.215-.963.597-1.345s.854-.531 1.345-.597c.459-.062 1.032-.062 1.697-.062zM16 3h2.5a.5.5 0 0 1 .5.5v4.14l-3.5-2.8V3.5A.5.5 0 0 1 16 3"
                            opacity="0.5" />
                    </svg> Inicio</a>
                <a href="javascript:void(0);" class="nav-link" onclick="cargarPagina('cardAdminPanel.php')"> <svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M20 6v6h-1v1h-1v1h-2v1h-6v-3h3v1h4v-1h1v-1h1V7h-1V5h-1V4h-1V3h-1V2H9v1H8v1H7v1H6v2H5v4H4v-1H3V7h1V6h1V4h1V3h1V2h1V1h8v1h1v1h1v1h1v2z" />
                        <path fill="currentColor"
                            d="M18 8v2h-1v1h-1v1h-2v-1H9v3H8v-1H7v-1H6V8h1V6h1V5h1V4h6v1h1v1h1v2zm4 11v3h-1v1H3v-1H2v-3h1v-1h1v-1h1v-1h4v1h6v-1h4v1h1v1h1v1z" />
                    </svg> Panel Administración</a>
                <a href="javascript:void(0);" class="nav-link" onclick="cargarPagina('usuariosAdmin.php')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="currentColor">
                        <path d="M12 7.5a1.75 1.75 0 1 0 0 3.5a1.75 1.75 0 0 0 0-3.5" />
                        <path
                            d="M13.435 2.075a3.33 3.33 0 0 0-2.87 0c-.394.189-.755.497-1.26.928l-.079.066a2.56 2.56 0 0 1-1.58.655l-.102.008c-.662.053-1.135.09-1.547.236a3.33 3.33 0 0 0-2.03 2.029c-.145.412-.182.885-.235 1.547l-.008.102a2.56 2.56 0 0 1-.655 1.58l-.066.078c-.431.506-.74.867-.928 1.261a3.33 3.33 0 0 0 0 2.87c.189.394.497.755.928 1.26l.066.079c.41.48.604.939.655 1.58l.008.102c.053.662.09 1.135.236 1.547a3.33 3.33 0 0 0 2.029 2.03q.122.042.253.074l.001-.645C6.434 15.883 9.272 14.11 12 14.11s5.566 1.773 5.749 5.352v.645q.132-.032.254-.075a3.33 3.33 0 0 0 2.03-2.029c.145-.412.182-.885.235-1.547l.008-.102c.05-.629.238-1.09.655-1.58l.066-.079c.431-.505.74-.866.928-1.26a3.33 3.33 0 0 0 0-2.87c-.189-.394-.497-.755-.928-1.26l-.066-.079a2.56 2.56 0 0 1-.655-1.58l-.008-.102c-.053-.662-.09-1.135-.236-1.547a3.33 3.33 0 0 0-2.029-2.03c-.412-.145-.885-.182-1.547-.235l-.102-.008a2.56 2.56 0 0 1-1.58-.655l-.079-.066c-.505-.431-.866-.74-1.26-.928M8.75 9.25a3.25 3.25 0 1 1 6.5 0a3.25 3.25 0 0 1-6.5 0" />
                        <path
                            d="m16.256 20.285l-.005-.747C16.117 16.93 14.114 15.61 12 15.61s-4.117 1.32-4.251 3.928c-.001.02-.003.276-.005.747c.58.061 1.019.25 1.482.646l.078.066c.506.431.867.74 1.261.928a3.33 3.33 0 0 0 2.87 0c.394-.189.755-.497 1.26-.928l.079-.066c.455-.388.891-.583 1.482-.646" />
                    </g>
                </svg> Gestionar
                    Usuarios</a>
                <a href="javascript:void(0);" class="nav-link" onclick="cargarPagina('productosAdmin.php')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M7 2H3a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1M5 21a2 2 0 1 1 2-2a2 2 0 0 1-2 2m2-9H3V3h4Zm-1 7a1 1 0 1 1-1-1a1 1 0 0 1 1 1m8-17h-4a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1m-2 19a2 2 0 1 1 2-2a2 2 0 0 1-2 2m2-9h-4V3h4Zm-1 7a1 1 0 1 1-1-1a1 1 0 0 1 1 1m8-17h-4a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1m-2 19a2 2 0 1 1 2-2a2 2 0 0 1-2 2m2-9h-4V3h4Zm-1 7a1 1 0 1 1-1-1a1 1 0 0 1 1 1" />
                </svg> Gestionar
                    Productos</a>
                <a href="javascript:void(0);" class="nav-link" onclick="cargarPagina('pedidosAdmin.php')"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m17.371 19.827l2.84-2.796l-.626-.627l-2.214 2.183l-.955-.975l-.627.632zM6.77 8.731h10.462v-1H6.769zM18 22.116q-1.671 0-2.835-1.165Q14 19.787 14 18.116t1.165-2.836T18 14.116t2.836 1.164T22 18.116q0 1.67-1.164 2.835Q19.67 22.116 18 22.116M4 20.769V4h16v7.56q-.244-.09-.484-.154q-.241-.064-.516-.1V5H5v14.05h6.344q.068.41.176.802q.109.392.303.748l-.034.034l-1.135-.826l-1.346.961l-1.346-.961l-1.346.961l-1.347-.961zm2.77-4.5h4.709q.056-.275.138-.515t.192-.485H6.77zm0-3.769h7.31q.49-.387 1.05-.645q.56-.259 1.197-.355H6.769zM5 19.05V5z" />
                </svg> Gestionar
                    Pedidos</a>
                <a href="registro.php" class="nav-link text-danger">❌ Cerrar Sesión</a>
            </nav>
        </div>
    </header>

    <!-- CONTENIDO DINÁMICO -->
    <iframe id="visor" src="cardAdminPanel.php"></iframe>

    <script>
        function cargarPagina(url) {
            const iframe = document.getElementById("visor");
            iframe.src = url;
        }
    </script>

</body>

</html>