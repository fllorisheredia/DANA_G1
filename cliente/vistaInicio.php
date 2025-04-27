<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../includes/db.php';

$servicios = $conexion->query("
    SELECT s.nombre, s.descripcion, s.fecha, u.nombre AS oferente
    FROM servicios s
    JOIN usuarios u ON s.usuario_ofrece_id = u.id
    ORDER BY s.fecha DESC LIMIT 4
");

$productos = $conexion->query("
    SELECT nombre, precio_tonkens, imagen 
    FROM productos 
    ORDER BY id DESC LIMIT 4
");

$id = $_SESSION['usuario']['id']; // asegúrate que exista esta sesión
$query = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$usuario = $query->get_result()->fetch_assoc();
?>

<link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">

<main class="p-6 space-y-12">

    <h1 class="text-xl font-bold">BIENVENIDO DE NUEVO <span class="text-purple-600"><?= $usuario['nombre'] ?></span></h1>

    <!-- Últimos servicios -->
    <section>
        <h2 class="text-2xl font-bold mb-4 text-purple-700">Servicios Añadidos Recientemente</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php while ($s = $servicios->fetch_assoc()): ?>
                <div class="card bg-white shadow-md">
                    <div class="card-body">
                        <h3 class="card-title"><?= htmlspecialchars($s['nombre']) ?></h3>
                        <p><?= htmlspecialchars($s['descripcion']) ?></p>
                        <p class="text-sm text-gray-500">Ofrecido por: <span class="font-medium"><?= htmlspecialchars($s['oferente']) ?></span></p>
                        <p class="text-sm text-gray-400">Fecha: <?= $s['fecha'] ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    
    
    <!-- Últimos productos -->
    <section>
        <h2 class="text-2xl font-bold mb-4 text-purple-700">Productos Añadidos Recientemente</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <?php while ($p = $productos->fetch_assoc()): ?>
                <div class="card bg-base-100 shadow">
                    <figure class="flex items-center justify-center h-32 bg-white rounded-t-xl p-2">
                        <img src="../<?= htmlspecialchars($p['imagen']) ?>" 
                             alt="<?= htmlspecialchars($p['nombre']) ?>" 
                             class="max-h-full max-w-full object-contain">
                    </figure>
                    <div class="card-body">
                        <h3 class="card-title"><?= htmlspecialchars($p['nombre']) ?></h3>
                        <p class="text-lg font-bold text-success">🪙<?= number_format($p['precio_tonkens']) ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

</main>
