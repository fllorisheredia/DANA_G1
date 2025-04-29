<?php
include '../includes/db.php';
$query = "SELECT * FROM servicios ORDER BY hora_realizar ASC";
$servicios = $conexion->query($query);
if (!$servicios) {
    die("Error al obtener los servicios: " . $conexion->error);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Subir Servicio</title>

    <!-- DaisyUI + Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
</head>

<?php if (isset($_GET['registro']) && $_GET['registro'] === 'exitoso'): ?>
<input type="checkbox" id="registroExitosoModal" class="modal-toggle" checked />
<div class="modal">
    <div class="modal-box text-center">
        <h2 class="text-2xl font-bold text-green-600 mb-4">Ayuda añadida!</h2>
        <p class="text-lg">La ayuda ha sido agregada correctamente, Gracias por tu aportación!</p>
        <div class="modal-action">
            <label for="registroExitosoModal" class="btn btn-success">Cerrar</label>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (isset($_GET['registro']) && $_GET['registro'] !== 'exitoso'): ?>
<input type="checkbox" id="registroExitosoModal" class="modal-toggle" checked />
<div class="modal">
    <div class="modal-box text-center">
        <h2 class="text-2xl font-bold text-red-600 mb-4">TU AYUDA NO HA SIDO AÑADIDA!</h2>
        <p class="text-lg">Tu ayuda no ha sido añadida, verifica bien los datos!</p>
        <div class="modal-action">
            <label for="registroExitosoModal" class="btn btn-success">Cerrar</label>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="text-center my-6">
    <h2 class="text-3xl font-semibold text-violet-600">Añade tus servicios</h2>
    <p class="text-lg text-white">Aquí puedes añadir los servicios que quieras ofrecer</p>
</div>

<div class="grid grid-cols-4 gap-6 mt-4">

    <!-- SERVICIO 1: Limpieza -->
    <form id="form1" action="subir.php" method="POST" class="card bg-white shadow-xl border border-gray-300 rounded-xl">
        <figure>
            <img src="../img/servicios.jfif" alt="Limpieza" class="h-48 w-full object-cover rounded-t-xl" />
        </figure>
        <div class="card-body items-center text-center">
            <h2 class="card-title text-violet-600">Servicios de limpieza</h2>
            <p class="text-gray-700 text-sm">Ofrecete de limpiador</p>
            <input type="hidden" name="nombreProducto" value="Limpieza">
            <input type="hidden" name="descripcion" value="Ofrezco ayuda con mis conocimientos en limpieza">
            <input type="hidden" name="categoria" value="Limpieza">
            <div class="card-actions mt-2">
                <button type="button" class="btn bg-[#9900ff] text-white"
                    onclick="mostrarModal('modal1')">Ofrecerse</button>
            </div>
        </div>
    </form>

    <!-- MODAL Limpieza -->
    <input type="checkbox" id="modal1" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box text-center">
            <h2 class="text-2xl font-bold mb-2">Información adicional</h2>
            <p class="mb-2">Fecha y hora de disponibilidad</p>
            <input type="datetime-local" id="inputHora" class="input input-bordered w-full max-w-xs mt-2" required>
            <textarea id="inputCiudad" class="textarea textarea-bordered w-full mt-4" placeholder="Ciudad afectada..."
                rows="3" required></textarea>
            <input type="hidden" name="hora" id="horaInput">
            <div class="modal-action">
                <button type="button" class="btn bg-[#9900ff] text-white" id="enviarBtn">Enviar</button>
                <label for="modal1" class="btn btn-success">Cerrar</label>
            </div>
        </div>
    </div>

    <!-- SERVICIO 2: Reparto -->
    <form id="form2" action="subir.php" method="POST" class="card bg-white shadow-xl border border-gray-300 rounded-xl">
        <figure>
            <img src="../img/repartidorcomida.jpg" alt="Comida" class="h-48 w-full object-cover rounded-t-xl" />
        </figure>
        <div class="card-body items-center text-center">
            <h2 class="card-title text-violet-600">Reparto de alimentos</h2>
            <p class="text-gray-700 text-sm">Entrega víveres a zonas afectadas</p>
            <input type="hidden" name="nombreProducto" value="Reparto de comida">
            <input type="hidden" name="descripcion" value="Distribuyo víveres en zonas afectadas por la DANA">
            <input type="hidden" name="categoria" value="Alimento">
            <div class="card-actions mt-2">
                <button type="button" class="btn bg-[#9900ff] text-white"
                    onclick="mostrarModal6('modal2')">Ofrecerse</button>
            </div>
        </div>
    </form>

    <!-- MODAL Reparto -->
    <input type="checkbox" id="modal2" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box text-center">
            <h2 class="text-2xl font-bold mb-2">Información adicional</h2>
            <p class="mb-2">Fecha y ciudad donde repartirás</p>
            <input type="datetime-local" id="inputHora6" class="input input-bordered w-full max-w-xs mt-2" required>
            <textarea id="inputCiudad6" class="textarea textarea-bordered w-full mt-4"
                placeholder="Ciudad a repartir..." rows="3" required></textarea>
            <input type="hidden" name="hora" id="horaInput6">
            <div class="modal-action">
                <button type="button" class="btn bg-[#9900ff] text-white" id="enviarBtn6">Enviar</button>
                <label for="modal2" class="btn btn-success">Cerrar</label>
            </div>
        </div>
    </div>

    <!-- SERVICIO 3: Bricolaje -->
    <form id="form3" action="subir.php" method="POST" class="card bg-white shadow-xl border border-gray-300 rounded-xl">
        <figure>
            <img src="../img/bricolaje.png" alt="Bricolaje" class="h-48 w-full object-cover rounded-t-xl" />
        </figure>
        <div class="card-body items-center text-center">
            <h2 class="card-title text-violet-600">Servicios de bricolaje</h2>
            <p class="text-gray-700 text-sm">Ayuda con reparaciones o montaje</p>
            <input type="hidden" name="nombreProducto" value="Bricolaje">
            <input type="hidden" name="descripcion" value="Ayudo con mis conocimientos de bricolaje">
            <input type="hidden" name="categoria" value="Bricolaje">
            <div class="card-actions mt-2">
                <button type="button" class="btn bg-[#9900ff] text-white"
                    onclick="mostrarModal7('modal3')">Ofrecerse</button>
            </div>
        </div>
    </form>

    <!-- MODAL Bricolaje -->
    <input type="checkbox" id="modal3" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box text-center">
            <h2 class="text-2xl font-bold mb-2">Información adicional</h2>
            <p class="mb-2">Fecha y ciudad donde ayudarás</p>
            <input type="datetime-local" id="inputHora7" class="input input-bordered w-full max-w-xs mt-2" required>
            <textarea id="inputCiudad7" class="textarea textarea-bordered w-full mt-4" placeholder="Ciudad afectada..."
                rows="3"></textarea>
            <div class="modal-action">
                <button type="button" class="btn bg-[#9900ff] text-white" id="enviarBtn7">Enviar</button>
                <label for="modal3" class="btn btn-success">Cerrar</label>
            </div>
        </div>
    </div>

    <!-- SERVICIO 4: Transporte -->
    <form id="form4" action="subir.php" method="POST" class="card bg-white shadow-xl border border-gray-300 rounded-xl">
        <figure>
            <img src="../img/coche.webp" alt="Transporte" class="h-48 w-full object-cover rounded-t-xl" />
        </figure>
        <div class="card-body items-center text-center">
            <h2 class="card-title text-violet-600">Transporte solidario</h2>
            <p class="text-gray-700 text-sm">Lleva personas o materiales a destino</p>
            <input type="hidden" name="nombreProducto" value="Transporte solidario">
            <input type="hidden" name="descripcion" value="Ofrezco transporte solidario hasta el siguiente destino:">
            <input type="hidden" name="categoria" value="Transporte">
            <div class="card-actions mt-2">
                <button type="button" class="btn bg-[#9900ff] text-white" onclick="mostrarModal2()">Ofrecerse</button>
            </div>
        </div>
    </form>

    <!-- MODAL Transporte -->
    <input type="checkbox" id="modal4" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box text-center">
            <h2 class="text-2xl font-bold mb-2">Información adicional</h2>
            <p class="mb-2">Fecha, origen y destino del viaje</p>
            <input type="datetime-local" id="inputHora2" class="input input-bordered w-full max-w-xs mt-2" required>
            <input type="text" id="inputOrigen" class="input input-bordered w-full mt-4" placeholder="Lugar de origen"
                required>
            <input type="text" id="inputDestino" class="input input-bordered w-full mt-4" placeholder="Lugar de destino"
                required>
            <div class="modal-action">
                <button type="button" class="btn bg-[#9900ff] text-white" id="enviarBtn4">Enviar</button>
                <label for="modal4" class="btn btn-success">Cerrar</label>
            </div>
        </div>
    </div>

</div>

<!-- Mensajes de sesión -->
<?php if (isset($_SESSION['mensaje_exito'])): ?>
<div class="alert alert-success"><?= $_SESSION['mensaje_exito'] ?></div>
<?php unset($_SESSION['mensaje_exito']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['mensaje_error'])): ?>
<div class="alert alert-error"><?= $_SESSION['mensaje_error'] ?></div>
<?php unset($_SESSION['mensaje_error']); ?>
<?php endif; ?>


<div class="text-center my-6">
    <h2 class="text-3xl font-semibold text-violet-600">Servicios recientes</h2>
    <p class="text-lg text-white">Aquí puedes ver los servicios más recientes ofrecidos</p>
</div>

<!-- Servicios -->
<?php if ($servicios->num_rows > 0): ?>
<div class="grid grid-cols-4 gap-6 mt-4">
    <?php while ($servicio = $servicios->fetch_assoc()): ?>
    <div class="card bg-white shadow-xl border border-gray-300 rounded-xl">
        <figure>
            <img src="../<?= htmlspecialchars($servicio['imagen']) ?>"
                alt="<?= htmlspecialchars($servicio['nombre']) ?>" class="h-48 w-full object-cover rounded-t-xl">
        </figure>
        <div class="card-body p-4">
            <h3 class="text-lg font-semibold text-violet-800"><?= htmlspecialchars($servicio['nombre']) ?></h3>
            <p class="text-sm text-gray-600">
                <span class="font-semibold text-black">Categoría:</span>
                <?= htmlspecialchars($servicio['categoria']) ?>
            </p>
            <p class="text-sm text-gray-600">
                <span class="font-semibold text-black">Fecha y hora:</span>
                <?= date("d/m/Y H:i", strtotime($servicio['hora_realizar'])) ?>
            </p>
            <?php if (!empty($servicio['origen'])): ?>
            <p class="text-sm text-gray-600">
                <span class="font-semibold text-black">Origen:</span> <?= htmlspecialchars($servicio['origen']) ?>
            </p>
            <?php endif; ?>
            <?php if (!empty($servicio['destino'])): ?>
            <p class="text-sm text-gray-600">
                <span class="font-semibold text-black">Destino:</span> <?= htmlspecialchars($servicio['destino']) ?>
            </p>
            <?php endif; ?>
        </div>
    </div>
    <?php endwhile; ?>
</div>
<?php else: ?>
<div class="alert alert-warning mt-6">🚫 No hay servicios disponibles actualmente.</div>
<?php endif; ?>



<script src="funciones.js"></script>
</body>

</html>