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


$id = $_SESSION['usuario']['id']; // asegúrate que exista esta sesión
$query = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$usuario = $query->get_result()->fetch_assoc();
?>
    <!-- Últimos servicios -->
    <section>
        <h2 class="text-2xl font-semibold mb-4">Últimos Servicios Añadidos</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php while ($s = $servicios->fetch_assoc()): ?>
                <div class="card bg-white shadow-md">
                    <div class="card-body">
                        <h3 class="card-title text-black font-bold"><?= htmlspecialchars($s['nombre']) ?></h3>
                        <p><?= htmlspecialchars($s['descripcion']) ?></p>
                        <p class="text-sm font-bold text-black">Ofrecido por: <span class="font-medium text-gray-400"><?= htmlspecialchars($s['oferente']) ?></span></p>
                        <p class="text-sm text-gray-400">Fecha: <?= $s['fecha'] ?></p>
                        <button class="btn btn-primary">Solicitar</button>

                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    