<?php
session_start();
include '../includes/db.php';
include '../cliente/header_cliente.php';

if (!isset($_SESSION['usuario'])) {
    die("Debes iniciar sesión para ver tu carrito.");
}

$usuarioId = $_SESSION['usuario']['id'];
$usuarioNombre = $_SESSION['usuario']['nombre'];

// CONSULTA CORREGIDA (traemos también el id del producto)
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

<head>
  <meta charset="UTF-8">
  <title>Tu Carrito</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg-base-200 text-base-content min-h-screen">

  <div class="flex flex-col max-w-4xl mx-auto p-6 mt-10 space-y-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold">🛒 Carrito de <?php echo htmlspecialchars($usuarioNombre); ?></h2>

    <ul class="flex flex-col divide-y">
      <?php while ($fila = $resultado->fetch_assoc()):
        $subtotal = $fila['precio_tonkens'] * $fila['cantidad'];
        $total += $subtotal;
      ?>
        <li class="flex flex-col py-6 sm:flex-row sm:justify-between">
          <div class="flex w-full space-x-4">

            <img src="../<?= htmlspecialchars($fila['imagen']) ?>" alt="<?= htmlspecialchars($fila['nombre']) ?>"
              class="h-48 w-full object-cover rounded-t-xl">

            <div class="flex flex-col justify-between w-full">
              <div class="flex justify-between w-full">
                <div>
                  <h3 class="text-lg font-semibold"><?php echo htmlspecialchars($fila['nombre']); ?></h3>
                  <p class="text-sm text-gray-600">Cantidad: <?php echo $fila['cantidad']; ?></p>
                </div>
                <div class="text-right">
                  <p class="text-lg font-semibold"><?php echo number_format($subtotal, 2); ?> Tonkens</p>
                  <p class="text-sm line-through text-gray-400"><?php echo number_format($fila['precio_tonkens'] * 1.2, 2); ?> Tonkens</p>

                  <div class="flex items-center gap-2 mt-2">
                    <form method="POST" action="eliminarProductoCarrito.php">
                        <input type="hidden" name="producto_id" value="<?= htmlspecialchars($fila['producto_id']) ?>">
                        <button type="submit" class="btn btn-error btn-sm">Quitar del Carrito</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </li>
      <?php endwhile; ?>
    </ul>

    <div class="text-right">
      <p class="text-lg font-bold">Total: <span class="text-purple-600"><?php echo number_format($total, 2); ?> Tonkens</span></p>
      <p class="text-sm text-gray-500">* No incluye impuestos ni envío</p>
    </div>

    <div class="flex justify-end gap-4">
      <a href="../cliente/dashboardCliente.php" class="btn btn-outline">← Volver a la tienda</a>
      <a href="checkout.php" class="btn btn-primary">Finalizar compra</a>
    </div>
  </div>

<?php include '../includes/footer.php'; ?>
</body>

</html>
