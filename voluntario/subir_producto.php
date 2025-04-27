<?php
include 'header_voluntario.php';
include '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Subir Producto</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

<?php if (isset($_GET['registro']) && $_GET['registro'] === 'exitoso'): ?>
<input type="checkbox" id="registroExitosoModal" class="modal-toggle" checked />
<div class="modal">
    <div class="modal-box text-center">
        <h2 class="text-2xl font-bold text-green-600 mb-4">¡Ayuda añadida!</h2>
        <p class="text-lg">Gracias por tu aportación ❤️</p>
        <div class="modal-action">
            <label for="registroExitosoModal" class="btn btn-success">Cerrar</label>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="flex gap-8 justify-center flex-wrap p-8">

  <!-- PRODUCTOS -->
  <?php
  $productos = [
    [
      'nombre' => 'Limpieza',
      'descripcion' => 'Ofrezco ayuda con mis conocimientos en limpieza',
      'imagen' => '../img/servicios.jfif'
    ],
    [
      'nombre' => 'Reparto de comida',
      'descripcion' => 'Distribuyo víveres en zonas afectadas por la DANA',
      'imagen' => '../img/repartidorcomida.jpg'
    ],
    [
      'nombre' => 'Bricolaje',
      'descripcion' => 'Ayudo con mis conocimientos de bricolaje',
      'imagen' => '../img/bricolaje.png'
    ],
    [
      'nombre' => 'Transporte solidario',
      'descripcion' => 'Ofrezco transporte solidario hasta el siguiente destino',
      'imagen' => '../img/coche.webp'
    ]
  ];

  foreach ($productos as $index => $producto): 
  ?>

  <form id="form<?= $index ?>" action="subir.php" method="POST" class="card bg-base-100 w-80 shadow-md" onsubmit="return false;">
    <figure class="px-10 pt-10">
      <img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="Imagen" class="rounded-xl w-64 h-64" />
    </figure>
    <div class="card-body items-center text-center">
      <h2 class="card-title"><?= htmlspecialchars($producto['nombre']) ?></h2>
      <p><?= htmlspecialchars($producto['descripcion']) ?></p>

      <!-- Campos ocultos -->
      <input type="hidden" name="nombreProducto" value="<?= htmlspecialchars($producto['nombre']) ?>">
      <input type="hidden" name="descripcion" value="<?= htmlspecialchars($producto['descripcion']) ?>">
      <input type="hidden" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>">

      <div class="card-actions mt-4">
        <button type="button" class="btn btn-primary" onclick="mostrarModal(<?= $index ?>)">Ofrecerse</button>
      </div>
    </div>
  </form>

  <?php endforeach; ?>

</div>

<!-- Modal genérico -->
<input type="checkbox" id="modalGeneral" class="modal-toggle" />
<div class="modal">
  <div class="modal-box text-center">
    <h2 class="text-2xl font-bold text-purple-600 mb-4">¡Perfecto!</h2>
    <p class="text-lg font-bold">¿A qué hora puedes asistir?</p>

    <input type="time" id="inputHoraGeneral" class="input input-bordered w-full max-w-xs mt-4" required>

    <div id="extraCampos" class="hidden mt-4">
      <textarea id="inputDestino" class="textarea textarea-bordered w-full mb-2" placeholder="Zona afectada..."></textarea>
      <textarea id="inputLlegada" class="textarea textarea-bordered w-full" placeholder="Destino final..."></textarea>
    </div>

    <div class="modal-action">
      <button type="button" id="btnEnviarGeneral" class="btn btn-primary">Enviar</button>
      <label for="modalGeneral" class="btn btn-success">Cancelar</label>
    </div>
  </div>
</div>

<script>
// Variables globales
let formActual = null;

// Mostrar modal y guardar el formulario
function mostrarModal(index) {
  formActual = document.getElementById("form" + index);
  document.getElementById("modalGeneral").checked = true;

  // Mostrar campos extra sólo si es transporte
  if (formActual.querySelector('input[name="nombreProducto"]').value === "Transporte solidario") {
    document.getElementById("extraCampos").classList.remove("hidden");
  } else {
    document.getElementById("extraCampos").classList.add("hidden");
  }
}

// Botón Enviar
document.getElementById("btnEnviarGeneral").onclick = function() {
  const hora = document.getElementById("inputHoraGeneral").value;
  const extraCampos = !document.getElementById("extraCampos").classList.contains("hidden");

  if (!hora) {
    alert("Por favor, indica la hora.");
    return;
  }

  const inputHoraHidden = document.createElement("input");
  inputHoraHidden.type = "hidden";
  inputHoraHidden.name = "hora";
  inputHoraHidden.value = hora;
  formActual.appendChild(inputHoraHidden);

  if (extraCampos) {
    const destino = document.getElementById("inputDestino").value;
    const llegada = document.getElementById("inputLlegada").value;

    if (!destino || !llegada) {
      alert("Completa todos los campos de destino y llegada.");
      return;
    }

    const inputDestinoHidden = document.createElement("input");
    inputDestinoHidden.type = "hidden";
    inputDestinoHidden.name = "destino";
    inputDestinoHidden.value = destino;
    formActual.appendChild(inputDestinoHidden);

    const inputLlegadaHidden = document.createElement("input");
    inputLlegadaHidden.type = "hidden";
    inputLlegadaHidden.name = "llegada";
    inputLlegadaHidden.value = llegada;
    formActual.appendChild(inputLlegadaHidden);
  }

  // Enviar formulario
  formActual.submit();
};
</script>

<?php include 'footer_voluntario.php'; ?>
</body>
</html>
