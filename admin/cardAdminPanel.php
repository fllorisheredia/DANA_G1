<?php  
include '../includes/db.php';
?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />

<div class=" bg-white p-6">
    <h1 class="text-3xl font-bold mb-6 text-black">Panel <span class="text-purple-500">Administración</span></h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Usuarios -->
        <div class="card bg-base-100 shadow-md border border-gray-700">
            <div class="card-body">
                <h2 class="card-title text-lg text-white">Últimos Usuarios</h2>
                <div class="overflow-x-auto">
                    <table class="table table-zebra text-sm">
                        <thead>
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
                    <a href="usuariosAdmin.php" class="btn btn-sm btn-outline btn-primary">Ver más</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Pedidos -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card border-secondary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Últimos Pedidos</h5>
                    <a href="pedidos.php" class="stretched-link text-decoration-none text-dark">
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Fecha</th>
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
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- Productos -->
    <div class="card bg-base-100 shadow-md border border-gray-700">
        <div class="card-body">
            <h2 class="card-title text-lg text-white">Últimos Productos</h2>
            <div class="overflow-x-auto">
                <table class="table table-zebra text-sm">
                    <thead>
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
                <a href="productosAdmin.php" class="btn btn-sm btn-outline btn-primary">Ver más</a>
            </div>
        </div>
    </div>

    <!-- Pedidos -->
    <div class="card bg-base-100 shadow-md border border-gray-700">
        <div class="card-body">
            <h2 class="card-title text-lg text-white">Últimos Pedidos</h2>
            <div class="overflow-x-auto">
                <table class="table table-zebra text-sm">
                    <thead>
                        <tr>
                            <th class="text-bold text-white">ID</th>
                            <th class="text-bold text-white">Estado</th>
                            <th class="text-bold text-white">Fecha</th>
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
                <a href="pedidosAdmin.php" class="btn btn-sm btn-outline btn-primary">Ver más</a>
            </div>
        </div>
    </div>

</div>
</div>