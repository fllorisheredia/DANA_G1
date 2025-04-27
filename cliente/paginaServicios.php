<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../includes/db.php';

// Obtener los últimos 4 servicios
$servicios = $conexion->query("
    SELECT s.nombre, s.descripcion, s.fecha, u.nombre AS oferente
    FROM servicios s
    JOIN usuarios u ON s.usuario_ofrece_id = u.id
    ORDER BY s.fecha DESC LIMIT 4
");

$id = $_SESSION['usuario']['id']; 
$query = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$usuario = $query->get_result()->fetch_assoc();
?>

<!-- Últimos servicios -->
<section class="p-6">
    <h2 class="text-3xl font-bold text-center text-violet-700 mb-8">📦 Últimos Servicios Añadidos</h2>

    <div class="flex flex-wrap gap-8 justify-center">

        <?php while ($s = $servicios->fetch_assoc()): ?>
            <div class="card w-80 bg-white shadow-md hover:shadow-xl transition-transform transform hover:scale-105">
                <div class="px-6 pt-6 flex justify-center">
                    <img src="../img/servicio_default.png" alt="Servicio" class="rounded-xl w-64 h-48 object-cover" />
                </div>
                <div class="card-body items-center text-center">
                    <h3 class="card-title text-violet-700 font-bold"><?= htmlspecialchars($s['nombre']) ?></h3>
                    <p class="text-gray-500"><?= htmlspecialchars($s['descripcion']) ?></p>
                    <p class="text-sm font-bold text-black mt-2">Ofrecido por: <span class="text-gray-400 font-medium"><?= htmlspecialchars($s['oferente']) ?></span></p>
                    <p class="text-xs text-gray-400 mb-4">Fecha: <?= date('d/m/Y', strtotime($s['fecha'])) ?></p>

                    <form action="solicitar.php" method="POST">
                        <input type="hidden" name="servicio_id" value="<?= htmlspecialchars($s['nombre']) ?>">
                        <button type="submit" class="btn bg-violet-700 hover:bg-violet-800 text-white w-full mt-2">
                            Solicitar
                        </button>
                    </form>
                </div>
            </div>
        <?php endwhile; ?>

    </div>
</section>
