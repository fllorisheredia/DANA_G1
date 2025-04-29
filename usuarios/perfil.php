<?php
session_start();
include '../includes/db.php';
// include '../includes/header_cliente.php';

$id = $_SESSION['usuario']['id'];

// Obtener información del usuario
$query = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$usuario = $query->get_result()->fetch_assoc();

// Consulta pedidos (solo 3 últimos)
$query2 = $conexion->prepare("SELECT id, estado FROM pedidos WHERE usuario_id = ? ORDER BY fecha DESC LIMIT 3");
$query2->bind_param("i", $id);
$query2->execute();
$resultPedidos = $query2->get_result();
$tienePedidos = $resultPedidos->num_rows > 0;

// Consulta mensajes: trae remitentes únicos que te enviaron mensaje
$query3 = $conexion->prepare("
    SELECT DISTINCT u.id, u.nombre
    FROM mensajes m
    INNER JOIN usuarios u ON m.remitente_id = u.id
    WHERE m.destinatario_id = ?
    ORDER BY m.fecha DESC
");
$query3->bind_param("i", $id);
$query3->execute();
$resultMensajes = $query3->get_result();
$tieneMensajes = $resultMensajes->num_rows > 0;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Perfil de <?php echo htmlspecialchars($usuario['nombre']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" />
</head>

<body class="bg-base-200 p-6">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Columna izquierda -->
        <div class="flex flex-col gap-6">

            <!-- Perfil -->
            <div class="card bg-base-100 shadow-md p-6 items-center text-center">


                <!-- IMAgend de perfilk -->
                <img src="../<?php echo htmlspecialchars($usuario['foto_perfil']); ?>" alt="Foto Perfil"
                    class="w-32 h-32 rounded-full mb-4">

                <h2 class="text-xl font-bold"><?php echo htmlspecialchars($usuario['nombre']); ?></h2>
                <p class="text-sm text-gray-500 font-bold">ROL: <?php echo htmlspecialchars($usuario['rol']); ?></p>
                <div class="mt-4 flex gap-2">
                    <a href="../mensajes/chat.php" class="btn btn-outline btn-sm">Mensaje</a>
                </div>
            </div>

            <!-- Redes -->
            <!-- Pedidos -->
            <div class="card bg-base-100 shadow-md p-6">
                <h2 class="font-semibold text-lg mb-4">📊 ULTIMOS PEDIDOS</h2>
                <div class="overflow-x-auto">
                    <?php if ($tienePedidos): ?>
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>ID Pedido</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($pedido = $resultPedidos->fetch_assoc()): ?>
                            <tr>
                                <td>#<?php echo $pedido['id']; ?></td>
                                <td><?php echo ucfirst($pedido['estado']); ?></td>

                            </tr>
                            <?php endwhile; ?>
                        </tbody>

                    </table>
                    <a href="../usuarios/pedidosUsuario.php?id=<?php echo $mensaje['id']; ?>"
                        class="btn btn-primary btn-sm">
                        Ver Todos los Pedidos
                    </a>
                    <?php else: ?>
                    <div class="alert alert-info">🚫 No tienes pedidos registrados todavía.</div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- Columna derecha -->
        <div class="md:col-span-2 flex flex-col gap-6">

            <!-- Información Personal -->
            <div class="card bg-base-100 shadow-md p-6">
                <h2 class="text-xl font-bold mb-4">Información Personal de
                    <?php echo htmlspecialchars($usuario['nombre']); ?></h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div><span class="font-semibold">Nombre:</span> <?php echo htmlspecialchars($usuario['nombre']); ?>
                    </div>
                    <div><span class="font-semibold">Email:</span> <?php echo htmlspecialchars($usuario['email']); ?>
                    </div>
                    <div><span class="font-semibold">Cantidad de Tonkens:</span>
                        <?php echo htmlspecialchars($usuario['tonkens']); ?></div>
                    <div><span class="font-semibold">Valoración:</span>
                        <?php echo htmlspecialchars($usuario['valoracion']); ?></div>
                </div>
                <div class="mt-6">
                    <a href="editar.php" class="btn btn-primary btn-sm">Editar Perfil</a>
                </div>
            </div>

            <!-- Mensajes y Pedidos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Mensajes -->
                <div class="card bg-base-100 shadow-md p-6">
                    <h2 class="font-semibold text-lg mb-4">📥 MENSAJES</h2>
                    <div class="overflow-x-auto">
                        <?php if ($tieneMensajes): ?>
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($mensaje = $resultMensajes->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($mensaje['nombre']); ?></td>
                                    <td>
                                        <a href="../mensajes/chat.php?id=<?php echo $mensaje['id']; ?>"
                                            class="btn btn-primary btn-sm">
                                            Ver conversación
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <div class="alert alert-info">📥 No tienes ningún mensaje todavía.</div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Pedidos
            <div class="card bg-base-100 shadow-md p-6">
                <h2 class="font-semibold text-lg mb-4">📊 ULTIMOS PEDIDOS</h2>
                <div class="overflow-x-auto">
                    <?php if ($tienePedidos): ?>
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>ID Pedido</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($pedido = $resultPedidos->fetch_assoc()): ?>
                                <tr>
                                    <td>#<?php echo $pedido['id']; ?></td>
                                    <td><?php echo ucfirst($pedido['estado']); ?></td>
                                 
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                         
                        </table>
                        <a href="../usuarios/pedidosUsuario.php?id=<?php echo $mensaje['id']; ?>" class="btn btn-primary btn-sm">
                                            Ver Todos los Pedidos
                                        </a>
                    <?php else: ?>
                        <div class="alert alert-info">🚫 No tienes pedidos registrados todavía.</div>
                    <?php endif; ?>
                </div>
            </div> -->

            </div>

        </div>

    </div>
</body>

</html>