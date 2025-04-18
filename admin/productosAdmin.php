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
            <!-- Tarjeta de producto -->
            <div class="relative">
                <a href="#"
                    class="block rounded-lg border border-gray-300 p-4 shadow-md hover:shadow-lg transition bg-white">
                    <div class="flex gap-4 items-start">
                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-900 mb-1">
                                <?php echo htmlspecialchars($row['nombre']); ?>
                            </h3>
                            <p class="text-sm text-gray-600 mb-2">
                                <?php echo htmlspecialchars($row['descripcion']); ?>
                            </p>
                            <div class="flex justify-between text-xs text-gray-600">
                                <span>🆔 ID: <?php echo $row['id']; ?></span>
                                <span>💰 <?php echo $row['precio_tonkens']; ?> Tokens</span>
                            </div>
                            <button onclick="toggleMenu(<?php echo $row['id']; ?>)"
                                class="mt-2 text-blue-600 hover:underline focus:outline-none">
                                Acciones
                            </button>
                        </div>
                    </div>
                </a>

                <!-- Menú flotante por producto -->
                <div id="menu-<?php echo $row['id']; ?>"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white rounded-lg shadow-lg w-96 max-w-full p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Opciones de Producto</h2>
                        <table class="w-full table-auto border border-gray-300">
                            <tbody>
                                <tr>
                                    <td class="p-2 border-b">
                                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full">
                                            Ver detalles
                                        </button>
                                    </td>
                                </tr>


                                <tr>
                                    <td class="p-2 border-b">
                                        <input type="text" placeholder="Cantidad" id="nuevoPrecio-<?php echo $row['id']; ?>"
                                            class="w-full border border-gray-300 px-2 py-1 rounded" />

                                        <button
                                            class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full"
                                            onclick="actualizarPrecio(<?php echo $row['id']; ?>)">
                                            Cambiar precio
                                        </button>

                                    </td>

                                </tr>
                                <tr>

                                <tr>
                                    <td class="p-2 border-b">
                                        <a href="eliminarUsuario.php?id=<?php echo $row['id']; ?>"
                                            class="block text-red-600 hover:underline w-full text-center">Eliminar
                                            Producto</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2">
                                        <button onclick="toggleMenu(<?php echo $row['id']; ?>)"
                                            class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 rounded">
                                            Cerrar
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script>
    function actualizarPrecio(id) {
        const input = document.getElementById(`nuevoPrecio-${id}`);
        const nuevoPrecio = input.value;

        if (!nuevoPrecio || isNaN(nuevoPrecio)) {
            alert("Introduce un precio válido");
            return;
        }



        alert(`Nuevo precio para el producto ${id}: ${nuevoPrecio}`);

        // Ejemplo si quieres redirigir a un archivo PHP:
        // window.location.href = `actualizarPrecio.php?id=${id}&precio=${nuevoPrecio}`;
    }
</script>

<script>
    function toggleMenu(id) {
        const menu = document.getElementById(`menu-${id}`);
        if (menu) menu.classList.toggle('hidden');
    }

    // Cerrar si haces clic fuera del contenido
    document.addEventListener("click", function (e) {
        document.querySelectorAll("[id^='menu-']").forEach(menu => {
            const content = menu.querySelector("div");
            if (menu.classList.contains("hidden")) return;
            if (!content.contains(e.target) && !e.target.matches("button")) {
                menu.classList.add("hidden");
            }
        });
    });
</script>