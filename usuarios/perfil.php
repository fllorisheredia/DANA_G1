<?php
// session_start();
include '../includes/db.php';
include '../includes/header_cliente.php';

$id = $_SESSION['usuario']['id']; // asegúrate que exista esta sesión
$query = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$usuario = $query->get_result()->fetch_assoc();



$query2 = $conexion->prepare("SELECT * FROM pedidos WHERE usuario_id = ? ORDER BY fecha DESC");
$query2->bind_param("i", $id_usuario);
$query2->execute();
$result = $query2->get_result();

$tienePedidos = $result->num_rows > 0;


$query3 = $conexion->prepare("SELECT * FROM mensajes WHERE destinatario_id = ? ORDER BY fecha DESC");
$query3->bind_param("i", $id_usuario);
$query3->execute();
$result3 = $query3->get_result();

$tieneMensajes = $result3->num_rows > 0;


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Perfil de </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.0.7/dist/full.css" rel="stylesheet" />
</head>

<body class="bg-base-200 p-6">

    <!-- rutas arriba izquierda -->
    <div class="text-sm breadcrumbs mb-6">
        <ul>
            <li><a href="#">Inicio</a></li>
            <li class="text-primary">Perfil</li>
        </ul>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Columna izquierda -->
        <div class="flex flex-col gap-6">

            <!-- Perfil -->
            <div class="card bg-base-100 shadow-md p-6 items-center text-center">
                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="w-32 h-32 rounded-full mb-4" />
                <h2 class="text-xl font-bold"><?php echo $usuario['nombre']; ?> </h2>
                <p class="text-sm text-gray-500 font-bold">ROL: <?php echo $usuario['rol']; ?></p>
                <div class="mt-4 flex gap-2">
                    <button class="btn btn-primary btn-sm">Seguir</button>
                    <button class="btn btn-outline btn-sm">Mensaje</button>
                </div>
            </div>

            <!-- Redes -->
            <div class="card bg-base-100 shadow-md p-4">
                <ul class="menu">
                    <h2 class="font-semibold text-lg mb-4">🐙 REDES SOCIALES</h2>

                    <li><a><span>🐦 Twitter</span> <span class="text-sm text-gray-500 ml-auto">@pepe1DANA</span></a>
                    </li>
                    <li><a><span>📸 Instagram</span> <span class="text-sm text-gray-500 ml-auto">pepe1DANA</span></a>
                    </li>
                    <li><a><span>📘 Facebook</span> <span class="text-sm text-gray-500 ml-auto">pepe1DANA</span></a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Columna derecha -->
        <div class="md:col-span-2 flex flex-col gap-6">

            <!-- Datos -->
            <div class="card bg-base-100 shadow-md p-6">
                <h2 class="text-xl font-bold mb-4">Información Personal de <?php echo $usuario['nombre']; ?></h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div><span class="font-semibold">Nombre:</span> <?php echo $usuario['nombre']; ?></div>
                    <div><span class="font-semibold">Email:</span> <?php echo $usuario['email']; ?></div>
                    <div><span class="font-semibold">Cantidad de Tonkens:</span> <?php echo $usuario['tonkens']; ?>
                    </div>
                    <div><span class="font-semibold">Valoración:</span> <?php echo $usuario['valoracion']; ?></div>
                    <!-- <div><span class="font-semibold">Dirección:</span> Bay Area, San Francisco, CA</div> -->
                </div>
                <div class="mt-6">
                    <a href="editar.php" class="btn btn-primary btn-sm">Editar Perfil</a>
                        </a>
                </div>
            </div>


            <!-- MENSAJES  -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="card bg-base-100 shadow-md p-6">
                    <h2 class="font-semibold text-lg mb-4">📥 MENSAJES</h2>
                    <div class="space-y-3 text-sm">

                        <?php if ($tieneMensajes): ?>
                        <?php while ($mensaje = $result3->fetch_assoc()): ?>
                        <div>
                            <span>Pedido #<?php echo $mensaje['id_remitente']; ?> - Estado:
                                <?php echo ucfirst($mensaje['fecha']); ?>
                                <?php echo ucfirst($mensaje['mensaje']); ?>

                            </span>
                            <!-- <progress class="progress progress-primary w-full"
                                        value="
                                        <?php echo $mensaje['mensaje'] === 'completado' ? 100 : ($mensaje['estado'] === 'enviado' ? 70 : 30); ?>
                                        "
                                        max="100"></progress>
                                </div> -->
                            <?php endwhile; ?>
                            <?php else: ?>
                            <div class="alert alert-info shadow-sm">
                                📥 No tienes ningun mensaje todavia.
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

                <!-- MIS PEDIDOS -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="card bg-base-100 shadow-md p-6">
                        <h2 class="font-semibold text-lg mb-4">📊 MIS PEDIDOS</h2>
                        <div class="space-y-3 text-sm">

                            <?php if ($tienePedidos): ?>
                            <?php while ($pedido = $result->fetch_assoc()): ?>
                            <div>
                                <span>Pedido #<?php echo $pedido['id']; ?> - Estado:
                                    <?php echo ucfirst($pedido['estado']); ?></span>
                                <progress class="progress progress-primary w-full"
                                    value="<?php echo $pedido['estado'] === 'completado' ? 100 : ($pedido['estado'] === 'enviado' ? 70 : 30); ?>"
                                    max="100"></progress>
                            </div>
                            <?php endwhile; ?>
                            <?php else: ?>
                            <div class="alert alert-info shadow-sm">
                                🚫 No tienes pedidos registrados todavía.
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

            </div>
        </div>


        <?php include '../includes/footer.php'; ?>


        
    <script>
        function cargarVista(pagina) {
            document.getElementById("iframeContenido").src = pagina;
        }

        function toggleTheme() {
            const html = document.documentElement;
            if (html.getAttribute('data-theme') === 'dark') {
                html.setAttribute('data-theme', 'light');
                document.getElementById('theme-icon').textContent = '🌙';
            } else {
                html.setAttribute('data-theme', 'dark');
                document.getElementById('theme-icon').textContent = '☀️';
            }
        }
    </script>
</body>

</html>