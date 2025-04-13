<?php
include '../includes/db.php';
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'administrador') {
    // header("Location: ../index.php");
    // exit();
}
$resultado = $conexion->query("SELECT * FROM usuarios");
include '../includes/header.php';
?>

<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-5">Lista de Usuarios</h1>
        <table class="table w-full table-zebra">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Contraseña</th>
                    <th>Rol</th>
                    <th>Tonkens</th>
                    <th>Insignias</th>
                    <th>Perfil Público</th>
                    <th>Valoración</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($usuario = $resultado->fetch_assoc()) { ?>
                    <!-- Fila de datos -->
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['nombre']; ?></td>
                        <td><?php echo $usuario['email']; ?></td>
                        <td><?php echo $usuario['password']; ?></td>
                        <td><?php echo $usuario['rol']; ?></td>
                        <td><?php echo $usuario['tonkens']; ?></td>
                        <td><?php echo $usuario['insignias']; ?></td>
                        <td><?php echo $usuario['perfil_publico']; ?></td>
                        <td><?php echo $usuario['valoracion']; ?></td>
                        <td>
                            <a href="#" class="btn btn-primary"
                                onclick="toggleMenu(<?php echo $usuario['id']; ?>); return false;">
                                Editar
                            </a>
                        </td>
                    </tr>

                    <!-- Fila desplegable oculta -->
                    <tr id="menu-content-<?php echo $usuario['id']; ?>" class="hidden">
                        <td colspan="10">
                            <div class="bg-gray-200 p-4 rounded shadow">
                                <h2 class="text-lg font-semibold text-black mb-4">Opciones de Usuario : </h2>

                                <form action="editar_usuario.php" method="POST"
                                    class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input type="hidden" name="usuario_id" value="<?php echo $usuario['id']; ?>">

                                    <div>
                                        <label class="font-semibold text-black">Nombre:</label>
                                        <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>"
                                            class="input bg-white input-bordered w-full" />
                                    </div>

                                    <div>
                                        <label class="font-semibold text-black">Email:</label>
                                        <input type="email" name="email" value="<?php echo $usuario['email']; ?>"
                                            class="input bg-white input-bordered w-full" />
                                    </div>

                                    <div>
                                        <label class="font-semibold text-black">Tonkens:</label>
                                        <input type="text" name="nombre" value="<?php echo $usuario['tonkens']; ?>"
                                            class="input bg-white input-bordered w-full" />
                                    </div>



                                    <div class="col-span-full text-right mt-2">
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php include '../includes/footer.php'; ?>

    <script>
        function toggleMenu(id) {
            document.querySelectorAll("tr[id^='menu-content-']").forEach(menu => {
                if (menu.id !== `menu-content-${id}`) {
                    menu.classList.add('hidden');
                }
            });

            const menu = document.getElementById(`menu-content-${id}`);
            menu.classList.toggle('hidden');
        }

        document.addEventListener("click", function (e) {
            const clickedMenuButton = e.target.closest("a.btn-primary");
            const clickedMenuContent = e.target.closest("tr[id^='menu-content-']");
            if (!clickedMenuButton && !clickedMenuContent) {
                document.querySelectorAll("tr[id^='menu-content-']").forEach(menu => {
                    menu.classList.add("hidden");
                });
            }
        });
    </script>
</body>