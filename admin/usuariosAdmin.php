<?php
include '../includes/db.php';

$resultado = $conexion->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg-base-100 text-base-content min-h-screen flex flex-col">

    <div class="container mx-auto px-4 py-10 flex-1">
        <h1 class="text-3xl text-white font-bold text-center mb-8">Lista de <span class="text-violet-700">Usuarios</span></h1>

        <div class="overflow-x-auto bg-white rounded-xl shadow-md">
            <table class="table table-zebra w-full text-white">
                <thead class="bg-base-300 text-base font-semibold text-sm uppercase">
                    <tr class="text-white">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Contraseña</th>
                        <th>Rol</th>
                        <th>Tonkens</th>
                        <th>Insignias</th>
                        <th>Perfil</th>
                        <th>Valoración</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-black">
                    <?php while ($usuario = $resultado->fetch_assoc()) { ?>
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
                            <a onclick="toggleMenu(<?php echo $usuario['id']; ?>); return false;"
                                class="btn btn-sm bg-violet-700 hover:bg-violet-800 text-white ">
                                Editar
                            </a>
                        </td>
                    </tr>

                    <!-- Menú Opciones de susuairio -->
                    <tr id="menu-content-<?php echo $usuario['id']; ?>" class="hidden bg-white">
                        <td colspan="10">
                            <div class="p-4 rounded-lg border bg-white bg-gray-50border-base-300">
                                <h2 class="text-lg font-semibold mb-4">Opciones del Usuario
                                    <?php echo $usuario['nombre'] ?></h2>
                                <form action="editar_usuario.php" method="POST"
                                    class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input type="hidden" name="usuario_id" value="<?php echo $usuario['id']; ?>">

                                    <div>
                                        <label class="label-text font-semibold">Cambiar Correo</label>

                                        <input type="email" id="email_<?php echo $usuario['id']; ?>"
                                            value="<?php echo $usuario['email']; ?>"
                                            class="input input-bordered w-full text-gray-400" />
                                        <a onclick="actualizarMail(<?php echo $usuario['id']; ?>); return false;"
                                            class="btn btn-sm btn-secondary mt-2">Actualizar</a>
                                    </div>
                                    <div>
                                        <label class="label-text font-semibold">Cambiar Contraseña</label>
                                        <input type="text" id="password_<?php echo $usuario['id']; ?>"
                                            placeholder="Nueva Contraseña..."
                                            class="input input-bordered w-full text-gray-400" />
                                        <a onclick="actualizarPassword(<?php echo $usuario['id']; ?>); return false;"
                                            class="btn btn-sm btn-secondary mt-2">Actualizar</a>
                                    </div>
                                    <div>
                                        <label class="label-text font-semibold">Cambiar nombre</label>
                                        <input type="text" id="nombre_<?php echo$usuario['id']; ?>"
                                            placeholder="Nuevo Nombre..."
                                            class="input input-bordered w-full text-gray-400" />
                                        <a onclick="actualizarNombre(<?php echo $usuario['id']; ?>); return false;"
                                            class="btn btn-sm btn-secondary mt-2">Actualizar</a>
                                    </div>

                                    <div>
                                        <label class="label-text font-semibold">Tonkens</label>
                                        <input type="text" id="tonkens_<?php echo $usuario['id']; ?>"
                                            placeholder="Nueva Cantidad..."
                                            class="input input-bordered w-full text-gray-400" />
                                        <a onclick="actualizarTonkens(<?php echo $usuario['id']; ?>); return false;"
                                            class="btn btn-sm btn-secondary mt-2">Actualizar</a>
                                    </div>
                                    <div>
                                        <label class="label-text font-semibold">Valoracion</label>
                                        <input type="text" id="valoracion_<?php echo $usuario['id']; ?>"
                                            value="<?php echo $usuario['valoracion']; ?>"
                                            class="input input-bordered w-full text-gray-400" />
                                        <a onclick="actualizarValoracion(<?php echo $usuario['id']; ?>); return false;"
                                            class="btn btn-sm btn-secondary mt-2">Actualizar</a>

                                    </div>
                                    <div>
                                        <label class="label-text font-semibold">Cambiar Rol</label>
                                        <select id="rol_<?php echo $usuario['id']; ?>"
                                            class="select select-bordered w-full text-gray-400">
                                            <option value="" disabled selected>Selecciona tu rol</option>
                                            <option value="cliente">Cliente</option>
                                            <option value="voluntario">Voluntario</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                        <a onclick="actualizarRol(<?php echo $usuario['id']; ?>); return false;"
                                            class="btn btn-sm btn-secondary mt-2">Actualizar</a>
                                    </div>


                                    <div class="col-span-full flex justify-end gap-3 mt-4">
                                        <button onclick="eliminarUsuario(<?php echo $usuario['id']; ?>); return false;"
                                            type="button" class="btn btn-error">
                                            Eliminar Usuario
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- <script src="funciones.js"></script> -->
    <script src="funciones.js"></script>

</body>

</html>