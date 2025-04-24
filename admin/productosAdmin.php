<?php
include '../includes/db.php';

$sql = "SELECT * FROM productos ORDER BY id DESC";
$result = $conexion->query($sql);
?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />

<div class="container mx-auto p-6">
  <h1 class="text-3xl font-bold mb-6">Lista de Productos</h1>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="relative bg-white rounded-lg shadow-md p-4 border border-gray-200">
        <h3 class="text-lg font-bold text-gray-800"><?php echo htmlspecialchars($row['nombre']); ?></h3>
        <p class="text-sm text-gray-600 mb-2"><?php echo htmlspecialchars($row['descripcion']); ?></p>
        <div class="text-sm text-gray-500 flex justify-between">
          <span>🆔 <?php echo $row['id']; ?></span>
          <span>💰 <?php echo $row['precio_tonkens']; ?> Tokens</span>
        </div>
        <button onclick="toggleMenu(<?php echo $row['id']; ?>)" class="btn btn-sm btn-secondary mt-3 w-full">
          Opciones
        </button>

        <div id="menu-<?php echo $row['id']; ?>" class="hidden mt-4 border rounded-lg p-4 bg-gray-50 shadow-inner">
          <form action="editar_producto.php" method="POST" class="grid grid-cols-1 gap-3 text-sm">
            <input type="hidden" name="producto_id" value="<?php echo $row['id']; ?>">

            <div>
              <label class="font-semibold">Cambiar Nombre</label>
              <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>"
                class="input input-bordered w-full" />
            </div>

            <div>
              <label class="font-semibold">Cambiar Descripción</label>
              <input type="text" name="descripcion" value="<?php echo $row['descripcion']; ?>"
                class="input input-bordered w-full" />
            </div>

            <div>
              <label class="font-semibold">Precio Tokens</label>
              <input type="number" name="precio_tonkens" value="<?php echo $row['precio_tonkens']; ?>"
                class="input input-bordered w-full" />
            </div>

          </form>
          <div class="flex justify-end gap-2 mt-3">
            <button type="submit" class="btn btn-success btn-sm">Guardar</button>
            <button type="button" onclick="eliminarProducto(<?= $row['id']; ?>)" class="btn btn-error btn-sm">Eliminar</button>
            </button>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<!-- <script src="funciones.js"></script> -->
<script src="funcionesProductos.js"></script>

<script>
  function toggleMenu(id) {
    const menu = document.getElementById(`menu-${id}`);
    if (menu) {
      menu.classList.toggle('hidden');
    }
  }

  // function eliminarProducto(id) {
  //   if (confirm("¿Estás seguro de que quieres eliminar este producto?")) {
  //     window.location.href = `borrarProducto.php?id=${id}`;
  //   }
  // }
</script>


