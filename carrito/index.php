// 4. /carrito/index.php
<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';
verificarSesion();

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<p>Tu carrito está vacío.</p>";
} else {
    echo "<h1>Carrito de Compras</h1>";
    echo "<table border='1'><tr><th>Producto</th><th>Precio (Tonkens)</th><th>Cantidad</th></tr>";
    foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
        $query = $conexion->prepare("SELECT nombre, precio_tonkens FROM productos WHERE id = ?");
        $query->bind_param("i", $id_producto);
        $query->execute();
        $resultado = $query->get_result()->fetch_assoc();
        echo "<tr><td>" . $resultado['nombre'] . "</td><td>" . $resultado['precio_tonkens'] . "</td><td>" . $cantidad . "</td></tr>";
    }
    echo "</table>";
    echo "<a href='checkout.php'>Finalizar Compra</a>";
}
include '../includes/footer.php';
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
    <?php while ($fila = $resultado->fetch_assoc()) :
      $subtotal = $fila['precio_tonkens'] * $fila['cantidad'];
      $total += $subtotal;
    ?>
    <li class="flex flex-col py-6 sm:flex-row sm:justify-between">
      <div class="flex w-full space-x-4">
        <img src="<?php echo $fila['imagen']; ?>" alt="<?php echo $fila['nombre']; ?>" 
             class="object-cover w-24 h-24 rounded-lg shadow-md">
        <div class="flex flex-col justify-between w-full">
          <div class="flex justify-between w-full">
            <div>
              <h3 class="text-lg font-semibold"><?php echo $fila['nombre']; ?></h3>
              <p class="text-sm text-gray-600">Cantidad: <?php echo $fila['cantidad']; ?></p>
            </div>
            <div class="text-right">
              <p class="text-lg font-semibold"><?php echo $subtotal; ?> Tonkens</p>
              <p class="text-sm line-through text-gray-400"><?php echo $fila['precio_tonkens'] * 1.2; ?> Tonkens</p>
            </div>
          </div>
        </div>
      </div>
    </li>
    <?php endwhile; ?>
  </ul>

  <div class="text-right">
    <p class="text-lg font-bold">Total: <span class="text-purple-600"><?php echo $total; ?> Tonkens</span></p>
    <p class="text-sm text-gray-500">* No incluye impuestos ni envío</p>
  </div>

  <div class="flex justify-end gap-4">
    <a href="../index.php" class="btn btn-outline">← Volver a la tienda</a>
    <a href="checkout.php" class="btn btn-primary">Finalizar compra</a>
  </div>
</div>
 <?php include '../includes/footer.php' ?>
</body>
</html>
