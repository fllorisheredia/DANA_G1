<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['usuario'])) {
  die("Debes iniciar sesión para ver tu carrito.");
}

$usuarioId = $_SESSION['usuario']['id'];
$usuarioNombre = $_SESSION['usuario']['nombre'];

$sql = "SELECT p.id AS producto_id, p.nombre, p.precio_tonkens, p.imagen, c.cantidad
        FROM carrito c
        JOIN productos p ON p.id = c.producto_id
        WHERE c.usuario_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuarioId);
$stmt->execute();
$resultado = $stmt->get_result();

$total = 0;
?>
<!DOCTYPE html>
<html lang="es">
<link rel="icon" type="image/x-icon" href="/DANA_G1/favicon.ico">

<head>
    <meta charset="UTF-8">
    <title>Tu Carrito</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg-base-200 text-base-content min-h-screen flex flex-col">

    <main class="flex-1 items-center">
        <div class="flex flex-col max-w-5xl mx-auto p-6 mt-10 space-y-8 bg-white rounded-lg shadow-lg">
            <h2 class="text-3xl font-extrabold text-violet-700 flex items-center gap-3 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
                    <path fill="#ccd6dd" d="M31 22H11L9 10h24z" />
                    <path fill="#66757f"
                        d="M32.984 27h-22C9.89 27 9 26.109 9 25.016S9.906 23 11 23l.007-.001l.008.001H31a1 1 0 0 0 .986-.836l2-12A.997.997 0 0 0 33 9H9.817l-1.04-6.166a.99.99 0 0 0-.942-.814H3a1 1 0 0 0 0 2h3.946l2.903 17.216c-1.642.493-2.849 2-2.849 3.8A3.99 3.99 0 0 0 10.984 29h22a1 1 0 1 0 0-2" />
                </svg>
                Carrito de <?php echo htmlspecialchars($usuarioNombre); ?>
            </h2>

            <ul class="flex flex-col divide-y">
                <?php while ($fila = $resultado->fetch_assoc()):
        $subtotal = $fila['precio_tonkens'] * $fila['cantidad'];
        $total += $subtotal;
        ?>
                <li class="flex flex-col sm:flex-row items-center py-6 gap-6 text-black">
                    <img src="../<?= htmlspecialchars($fila['imagen']) ?>"
                        alt="<?= htmlspecialchars($fila['nombre']) ?>"
                        class="h-32 w-32 rounded-lg object-cover shadow" />

                    <div class="flex-1 flex flex-col justify-between">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold"><?= htmlspecialchars($fila['nombre']); ?></h3>
                                <p class="text-sm text-gray-500">Cantidad: <?= $fila['cantidad']; ?></p>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-semibold text-success"><?= number_format($subtotal, 2); ?>
                                    Tonkens</p>
                                <p class="text-sm line-through text-gray-400">
                                    <?= number_format($fila['precio_tonkens'] * 1.2, 2); ?> Tonkens</p>

                                <form method="POST" action="eliminarProductoCarrito.php" class="mt-3">
                                    <input type="hidden" name="producto_id"
                                        value="<?= htmlspecialchars($fila['producto_id']) ?>">
                                    <button type="submit" class="btn btn-error btn-xs hover:scale-125">Quitar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
                <?php endwhile; ?>
            </ul>

            <div class="text-right">
                <p class="text-2xl font-bold text-black">Total: <span
                        class="text-purple-600"><?php echo number_format($total, 2); ?> Tonkens</span></p>
            </div>

            <div class="flex justify-end gap-4">
                <a onclick="parent.cargarVista('../cliente/vistaInicio.php'); return false;"
                    class="btn btn-outline btn-sm text-black hover:scale-125 hover:mr-5">← Volver a la tienda</a>
                <a href="#" onclick="parent.cargarVista('../carrito/checkout.php'); return false;"
                    class="btn bg-violet-700 btn-sm hover:scale-125 hover:ml-5 text-white">Finalizar compra</a>
            </div>

        </div>
    </main>

</body>

</html>