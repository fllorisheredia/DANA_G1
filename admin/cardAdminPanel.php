<!-- cardsPanelAdmin.php -->

<!-- <h1 class=" pl-6 display-5 fw-bold my-5 text-secondary">Panel de Administración</h1> -->


<?php  
include '../includes/db.php';

?>
 <!-- Bootstrap 5 CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap 5 Bundle JS (con Popper incluido) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/DANA0/css/style.css">



<div class="container-fluid pt-5 pb-3">
<h1 class="site-title pt-10 ">Panel <span class="highlight">Administración</span></h1>

    <div class="row g-4">

        <!-- Tarjeta de Usuarios -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card border-secondary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Últimos Usuarios</h5>
                    <a href="usuarios2.php" class="stretched-link text-decoration-none text-dark">
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
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
                    </a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Productos -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card border-secondary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Últimos Productos</h5>
                    <a href="productos2.php" class="stretched-link text-decoration-none text-dark">
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Precio</th>
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
                    </a>
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
</div>
