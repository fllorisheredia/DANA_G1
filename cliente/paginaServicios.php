<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../includes/db.php';

// Si no hay sesión de usuario, redirigir
if (!isset($_SESSION['usuario']['id'])) {
    header('Location: ../login.php');
    exit();
}

// Obtener usuario logueado
$id = $_SESSION['usuario']['id'];
$query = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$usuario = $query->get_result()->fetch_assoc();

// Obtener servicios (opcional: puedes agregar WHERE usuario_solicita_id IS NULL para filtrar los ya solicitados)
$servicios = $conexion->query("
    SELECT s.id, s.nombre, s.hora_realizar, s.descripcion, s.fecha, s.imagen, s.categoria, s.destino, s.origen, u.nombre AS oferente
    FROM servicios s
    JOIN usuarios u ON s.usuario_ofrece_id = u.id
    WHERE s.id NOT IN (
        SELECT servicio_id FROM servicios_solicitados
    )
    ORDER BY s.categoria ASC, s.fecha DESC
");

// Agrupar servicios por categoría
$serviciosPorCategoria = [];
while ($s = $servicios->fetch_assoc()) {
    $categoria = $s['categoria'] ?? 'Otros';
    $serviciosPorCategoria[$categoria][] = $s;
}
?>

<?php if (isset($_GET['solicitud']) && $_GET['solicitud'] === 'ok'): ?>
<div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md w-full text-center">
        <h2 class="text-3xl font-bold text-green-600 mb-4">¡Servicio solicitado correctamente!</h2>
        <p class="text-gray-700 text-lg mb-6">Un voluntario se pondrá en contacto contigo muy pronto 🚀</p>
        <a href="paginaServicios.php" class="btn bg-violet-700 hover:bg-violet-800 text-white w-full">
            Cerrar
        </a>
    </div>
</div>
<?php endif; ?>
<?php foreach ($servicios as $s): ?>
<?php 
        $fechaHoraFormateada = (new DateTime($s['hora_realizar']))->format('d-m-Y H:i');
    ?>
<?php endforeach ?>

<link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>

<!-- Sección de Servicios -->
<section class="p-10">

    <!-- Título principal -->
    <div class="text-center mb-12">
        <h2 class="text-4xl font-extrabold text-violet-700 flex items-center justify-center gap-3">
            <svg class="w-8 h-8 text-violet-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 22s8-4.434 8-10V5l-8-3-8 3v7c0 5.566 8 10 8 10z" />
            </svg>
            Servicios Disponibles
        </h2>
        <p class="text-gray-500 mt-2">Encuentra la ayuda que necesitas rápidamente</p>
    </div>

    <!-- Categorías -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <?php foreach ($serviciosPorCategoria as $categoria => $servicios): ?>
        <div class="bg-white rounded-3xl shadow-xl p-8 hover:shadow-2xl transition">

            <!-- Título de Categoría -->
            <h3 class="text-2xl font-bold text-purple-700 mb-6 border-b-2 border-violet-200 pb-2">
                <?= htmlspecialchars($categoria) ?>
            </h3>
            <!-- Servicios dentro de la categoría -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <?php foreach ($servicios as $s): ?>
                <div class="flex flex-col items-center bg-violet-50 rounded-2xl p-4 hover:bg-violet-100 transition">
                    <img src="<?= htmlspecialchars(!empty($s['imagen']) ? "../" . $s['imagen'] : '../img/logoSinF.png') ?>"
                        alt="Servicio" class="w-24 h-24 rounded-lg object-cover shadow-md mb-3" />
                    <h4 class="text-lg font-semibold text-violet-800"><?= htmlspecialchars($s['nombre']) ?></h4>
                    <p class="text-sm text-black">Hora del servicio: <span
                            class="text-gray-500 text-sm text-center mb-2"><?= htmlspecialchars($fechaHoraFormateada) ?></span>
                    </p>
                    <?php switch ($categoria): 
                        case 'transporte': ?>
                    <p class="text-sm text-black">Origen del servicio:
                        <span class="text-gray-500"><?= htmlspecialchars($s['origen'] ?? null) ?></span>
                    </p>
                    <p class="text-sm text-black">Destino del servicio:
                        <span class="text-gray-500"><?= htmlspecialchars($s['destino'] ?? null) ?></span>
                    </p>
                    <?php break; ?>

                    <?php case 'alimento': ?>
                    <p class="text-sm text-black">Destino del servicio:
                        <span class="text-gray-500"><?= htmlspecialchars($s['destino'] ?? null) ?></span>
                    </p>
                    <?php break; ?>

                    <?php case 'bricolaje': ?>
                    <p class="text-sm text-black">Centro de atención:
                        <span class="text-gray-500"><?= htmlspecialchars($s['destino'] ?? null) ?></span>
                    </p>
                    <?php break; ?>

                    <?php case 'limpieza': ?>
                    <p class="text-sm text-black">Ubicación:
                        <span class="text-gray-500"><?= htmlspecialchars($s['destino'] ?? null) ?></span>
                    </p>
                    <?php break; ?>
                    <?php endswitch; ?>

                    <form action="solicitarServicio.php" method="POST" class="w-full">
                        <input type="hidden" name="servicio_id" value="<?= htmlspecialchars($s['id']) ?>">
                        <button type="submit" class="btn btn-sm bg-violet-700 hover:bg-violet-800 text-white w-full">
                            Solicitar
                        </button>
                    </form>

                </div>
                <?php endforeach; ?>
            </div>

        </div>
        <?php endforeach; ?>
    </div>

</section>