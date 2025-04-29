<?php  
include '../includes/db.php';
?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />

<div class="bg-base-100 p-6">
    <h1 class="text-3xl font-bold text-white text-center mb-8">Panel de <span class="text-violet-700">Administración</span></h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Usuarios -->
        <div class="card bg-white shadow-md border border-gray-700">
            <div class="card-body">
                <h2 class="card-title text-lg text-violet-700 font-bold">Últimos Usuarios</h2>
                <div class="overflow-x-auto">
                    <table class="table text-sm text-black">
                        <thead class="text-black">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
              $sqlUsuarios = "SELECT id, nombre FROM usuarios LIMIT 3";
              $resultUsuarios = $conexion->query($sqlUsuarios);
              while ($row = $resultUsuarios->fetch_assoc()) {
                echo "<tr><td>{$row['id']}</td><td>{$row['nombre']}</td></tr>";
              }
              ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-actions justify-end mt-3">
                    <a href="usuariosAdmin.php" class="btn btn-sm text-white bg-violet-700 hover:bg-violet-800 hover:scale-125">Ver más</a>
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="card bg-white shadow-md border border-gray-700">
            <div class="card-body">
                <h2 class="card-title text-lg text-violet-700 font-bold">Últimos Productos</h2>
                <div class="overflow-x-auto ">
                    <table class="table text-sm text-black">
                        <thead class="text-black">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
              $sqlProductos = "SELECT id, nombre, precio_tonkens FROM productos LIMIT 3";
              $resultProductos = $conexion->query($sqlProductos);
              while ($row = $resultProductos->fetch_assoc()) {
                echo "<tr><td>{$row['id']}</td><td>{$row['nombre']}</td><td>{$row['precio_tonkens']}</td></tr>";
              }
              ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-actions justify-end mt-3">
                    <a href="productosAdmin.php" class="btn btn-sm text-white bg-violet-700 hover:bg-violet-800 hover:scale-125">Ver más</a>
                </div>
            </div>
        </div>

        <!-- Pedidos -->
        <div class="card bg-white shadow-md border border-gray-700">
            <div class="card-body">
                <h2 class="card-title text-lg text-violet-700 font-bold">Últimos Pedidos</h2>
                <div class="overflow-x-auto">
                    <table class="table text-sm text-black">
                        <thead>
                            <tr>
                                <th class="text-bold text-black">ID</th>
                                <th class="text-bold text-black">Estado</th>
                                <th class="text-bold text-black">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
              $sqlPedidos = "SELECT id, estado, fecha FROM pedidos LIMIT 3";
              $resultPedidos = $conexion->query($sqlPedidos);
              while ($row = $resultPedidos->fetch_assoc()) {
                echo "<tr><td>{$row['id']}</td><td>{$row['estado']}</td><td>{$row['fecha']}</td></tr>";
              }
              ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-actions justify-end mt-3">
                    <a href="pedidosAdmin.php" class="btn btn-sm text-white bg-violet-700 hover:bg-violet-800 hover:scale-125">Ver más</a>
                </div>
            </div>
        </div>
        <!-- Servicios -->
        <div class="card bg-white shadow-md border border-gray-700">
            <div class="card-body">
                <h2 class="card-title text-lg text-violet-700 font-bold">Últimos Servicios</h2>
                <div class="overflow-x-auto">
                    <table class="table text-sm text-black">
                        <thead>
                            <tr>
                                <th class="text-bold text-black">ID</th>
                                <th class="text-bold text-black">Estado</th>
                                <th class="text-bold text-black">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
              $sqlPedidos = "SELECT id, categoria, fecha FROM servicios LIMIT 3 ";
              $resultPedidos = $conexion->query($sqlPedidos);
              while ($row = $resultPedidos->fetch_assoc()) {
                echo "<tr><td>{$row['id']}</td><td>{$row['categoria']}</td><td>{$row['fecha']}</td></tr>";
              }
              ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-actions justify-end mt-3">
                    <a href="pedidosAdmin.php" class="btn btn-sm text-white bg-violet-700 hover:bg-violet-800 hover:scale-125">Ver más</a>
                </div>
            </div>
        </div>

    </div>
</div>

</div>