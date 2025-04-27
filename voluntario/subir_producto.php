<?php
include 'header_voluntario.php';
include '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Subir Producto</title>
  </head>

<?php if (isset($_GET['registro']) && $_GET['registro'] === 'exitoso'): ?>
<input type="checkbox" id="registroExitosoModal" class="modal-toggle" checked />
<div class="modal">
    <div class="modal-box text-center">
        <h2 class="text-2xl font-bold text-green-600 mb-4">Ayuda añadida!</h2>
        <p class="text-lg">La ayuda ha sido agregada correctamente, Gracias por tu aportación! </p>
        <div class="modal-action">
            <label for="registroExitosoModal" class="btn btn-success">Cerrar</label>
        </div>
    </div>
</div>
<?php endif; ?>
<body>
<div class="flex gap-4 justify-center flex-wrap">

  <!-- PRODUCTO 1 -->
  <form id="form1" action="subir.php" method="POST" class="card bg-base-100 w-96 shadow-sm" onsubmit="return false;">
    <figure class="px-10 pt-10">
      <img src="../img/servicios.jfif" alt="Limpieza" class="rounded-xl w-64 h-64" />
    </figure>
    <div class="card-body items-center text-center">
      <h2 class="card-title">Ofrecerse de Limpieza</h2>
      <p>Ofrecete de limpiador</p>
      <input type="hidden" name="nombreProducto" value="Limpieza">
      <input type="hidden" name="descripcion" value="Ofrezco ayuda con mis conocimientos en limpieza">
      
      <div class="card-actions mt-2">
        <button type="button" class="btn btn-primary" onclick="mostrarModal('modal1')">Ofrecerse</button>
      </div>
    </div>
  </form>

<!-- Modal para Producto 1 -->
<input type="checkbox" id="modal1" class="modal-toggle" />
<div class="modal">
  <div class="modal-box text-center">
    <h2 class="text-2xl font-bold text-white-600 mb-4">Perfecto, solo falta una pequeña informacion</h2>
    <p class="text-lg font-bold">Necesitamos Saber La Hora Que Puede Asistir</p>

    <!-- Input manual de hora -->
    <p class="text-lg mt-4"></p>
    <input type="time" id="inputHora" class="input input-bordered w-full max-w-xs mt-2" required>
     <!-- Textarea para destino -->
     <textarea id="inputCiudad" class="textarea textarea-bordered w-full mt-4" rows="3" placeholder="Ciudad Afectada que vas a ayudar..." required></textarea>

    <!-- Campo oculto para pasar al formulario -->
    <input type="hidden" name="hora" id="horaInput">

    <!-- Mensaje para confirmar -->
    <div class="mt-4">
      <p id="horaSeleccionada" class="text-lg text-blue-600"></p>
    </div>

    <!-- Acciones -->
    <div class="modal-action">
      <button type="button" class="btn btn-primary" id="enviarBtn">Enviar</button>
      <label for="modal1" class="btn btn-success">Cerrar</label>
    </div>
  </div>
</div>

  <!-- PRODUCTO 2 -->
  <form id="form2" action="subir.php" method="POST" class="card bg-base-100 w-96 shadow-sm">
    <figure class="px-10 pt-10">
      <img src="../img/repartidorcomida.jpg" alt="Comida" class="rounded-xl w-64 h-64" />
    </figure>
    <div class="card-body items-center text-center">
      <h2 class="card-title">Ofrecerse a repartir alimento</h2>
      <p>Ofrecete a llevar alimentos a las casas de los más necesitados</p>
      <input type="hidden" name="nombreProducto" value="Reparto de comida">
      <input type="hidden" name="descripcion" value="Distribuyo víveres en zonas afectadas por la DANA">
      
      <div class="card-actions mt-2">
        <button type="button" class="btn btn-primary" onclick="mostrarModal6('modal2')">Ofrecerse</button>
      </div>
    </div>
  </form>

  <!-- Modal para Producto 2 -->
  <input type="checkbox" id="modal2" class="modal-toggle" />
<div class="modal">
  <div class="modal-box text-center">
    <h2 class="text-2xl font-bold text-white-600 mb-4">Perfecto, solo falta una pequeña informacion</h2>
    <p class="text-lg font-bold">Necesitamos Saber La Hora Que Puede Asistir</p>

    <!-- Input manual de hora -->
    <p class="text-lg mt-4"></p>
    <input type="time" id="inputHora6" class="input input-bordered w-full max-w-xs mt-2" required>
     <!-- Textarea para destino -->
     <textarea id="inputCiudad6" class="textarea textarea-bordered w-full mt-4" rows="3" placeholder="Ciudad Afectada que vas a repartir comida..." required></textarea>

    <!-- Campo oculto para pasar al formulario -->
    <input type="hidden" name="hora" id="horaInput6">

    <!-- Mensaje para confirmar -->
    <div class="mt-4">
      <p id="horaSeleccionada" class="text-lg text-blue-600"></p>
    </div>

    <!-- Acciones -->
    <div class="modal-action">
      <button type="button" class="btn btn-primary" id="enviarBtn6">Enviar</button>
      <label for="modal2" class="btn btn-success">Cerrar</label>
    </div>
  </div>
</div>


  <!-- PRODUCTO 3 -->
  <form id="form3" action="subir.php" method="POST" class="card bg-base-100 w-96 shadow-sm">
    <figure class="px-10 pt-10">
      <img src="../img/bricolaje.png" alt="servicios" class="rounded-xl w-64 h-64" />
    </figure>
    <div class="card-body items-center text-center">
      <h2 class="card-title">Ofrecerse de bricolaje</h2>
      <p>Usa tus conocimientos para ayudar a otros</p>
      <input type="hidden" name="nombreProducto" value="Bricolaje">
      <input type="hidden" name="descripcion" value="Ayudo con mis conocimientos de bricolaje">
      
      <div class="card-actions mt-2">
        <button type="button" class="btn btn-primary" onclick="mostrarModal7('modal3')">Ofrecerse</button>
      </div>
    </div>
  </form>

  <!-- Modal para Producto 3 -->
  <input type="checkbox" id="modal3" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box text-center">
      <h2 class="text-2xl font-bold text-green-600 mb-4">¡Producto añadido!</h2>
      <p class="text-lg">El producto ha sido agregado correctamente, gracias por tu aportación!</p>
      
      <!-- Input manual de hora -->
    <p class="text-lg mt-4"></p>
    <input type="time" id="inputHora7" class="input input-bordered w-full max-w-xs mt-2" required>

      <!-- Bloque de texto para comentarios -->
      <textarea id="inputCiudad7" placeholder="Comentarios adicionales..." class="textarea textarea-bordered w-full mt-4" rows="3"></textarea>
      
      <div class="modal-action">
        <button type="button" class="btn btn-primary" id="enviarBtn7">Enviar</button>
        <label for="modal3" class="btn btn-success">Cerrar</label>
      </div>
    </div>
  </div>

  <!-- PRODUCTO 4 -->
  <form id="form4" action="subir.php" method="POST" class="card bg-base-100 w-96 shadow-sm" onsubmit="return false;">
    <figure class="px-10 pt-10">
      <img src="../img/coche.webp" alt="transporte" class="rounded-xl w-64 h-64" />
    </figure>
    <div class="card-body items-center text-center">
      <h2 class="card-title">Ofrecerse de Transporte</h2>
      <p>Ayuda transportando personas o cosas</p>
      <input type="hidden" name="nombreProducto" value="Transporte solidario">
      <input type="hidden" name="descripcion" value="Ofrezco transporte solidario hasta el siguiente destino:">
      
      <div class="card-actions mt-2">
        <button type="button" class="btn btn-primary" onclick="mostrarModal2('modal4')">Ofrecerse</button>
      </div>
    </div>
  </form>

  <!-- Modal para Producto 4 -->
  <form method="post" action="subir.php"> <!-- ajusta la ruta -->
  <input type="checkbox" id="modal4" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box text-center">
      <h2 class="text-2xl font-bold text-white-600 mb-4">Perfecto, solo falta una pequeña información</h2>
      <p class="text-lg font-bold">Necesitamos saber la hora que puede asistir y el destino</p>

      <!-- Input manual de hora -->
      <input type="time" id="inputHora2" class="input input-bordered w-full max-w-xs mt-4" required>

      <!-- Textarea para destino -->
      <textarea id="inputDestino2" class="textarea textarea-bordered w-full mt-4" rows="3" placeholder="Escribe Zona Afectada..." required></textarea>
      <textarea id="inputLlegada" class="textarea textarea-bordered w-full mt-4" rows="3" placeholder="Escribe Tu Destino Final..." required></textarea>

      <!-- Mensaje para confirmar -->
      <div class="mt-4">
        <p id="mensajeConfirmacion" class="text-lg text-blue-600"></p>
      </div>

      <!-- Acciones -->
      <div class="modal-action">
        <button type="button" class="btn btn-primary" id="enviarBtn4">Enviar</button>
        <label for="modal4" class="btn btn-success">Cerrar</label>
      </div>
    </div>
  </div>
</form>

 <!-- PRODUCTO 5 -->
 <form id="form5" action="subir.php" method="POST" class="card bg-base-100 w-96 shadow-sm" onsubmit="return false;">
    <figure class="px-10 pt-10">
      <img src="../img/maestro.jpg" alt="transporte" class="rounded-xl w-64 h-64" />
    </figure>
    <div class="card-body items-center text-center">
      <h2 class="card-title">Ofrecerse de ayudante de tareas escolares</h2>
      <p>Apoyo escolar para niños en situación vulnerable.</p>
      <input type="hidden" name="nombreProducto" value="Ayuda con tareas escolares">
      <input type="hidden" name="descripcion" value="Apoyo escolar para niños en situación vulnerable.">
      
      <div class="card-actions mt-2">
        <button type="button" class="btn btn-primary" onclick="mostrarModal3('modal5')">Ofrecerse</button>
      </div>
    </div>
  </form>

  <!-- Modal para Producto 5 -->
  <form method="post" action="subir.php"> 
  <input type="checkbox" id="modal5" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box text-center">
      <h2 class="text-2xl font-bold text-white-600 mb-4">Perfecto, solo falta una pequeña información</h2>
      <p class="text-lg font-bold">Necesitamos saber tu especialidad (ingles, matematicas, etc...)</p>

      <!-- Input manual de hora -->
      <input type="time" id="inputHora3" class="input input-bordered w-full max-w-xs mt-4" required>

      <!-- Textarea para destino -->
      <textarea id="inputEspecialidad2" class="textarea textarea-bordered w-full mt-4" rows="3" placeholder="Especialidad..." required></textarea>

      <!-- Mensaje para confirmar -->
      <div class="mt-4">
        <p id="mensajeConfirmacion" class="text-lg text-blue-600"></p>
      </div>

      <!-- Acciones -->
      <div class="modal-action">
        <button type="button" class="btn btn-primary" id="enviarBtn5">Enviar</button>
        <label for="modal5" class="btn btn-success">Cerrar</label>
      </div>
    </div>
  </div>
</form>

<script>
  // Mostrar el modal al activar el botón de "Ofrecerse"
  function mostrarModal() {
  document.getElementById("modal1").checked = true;
  

  // Al hacer clic en "Enviar", agregar la hora seleccionada y otros datos al formulario y enviarlo
  const horaSeleccionada = document.getElementById("inputHora").value;

  document.getElementById("enviarBtn").onclick = function() {
  const horaSeleccionada = document.getElementById("inputHora").value;
  const ciudadAyudar = document.getElementById("inputCiudad").value;
  if (!horaSeleccionada || !ciudadAyudar) {
    alert("Por favor, Completa Todos Los Campos.");
    return;
  }

  const form = document.querySelector("form");

  const inputHora = document.createElement("input");
  inputHora.type = "hidden";
  inputHora.name = "hora";
  inputHora.value = horaSeleccionada;
  form.appendChild(inputHora); 

  const inputCiudad = document.createElement("input");
  inputCiudad.type = "hidden";
  inputCiudad.name = "ciudad";
  inputCiudad.value = ciudadAyudar;
  form.appendChild(inputCiudad); 

  form.submit();
  }};
  
function mostrarModal2() {
  document.getElementById("modal4").checked = true; // Abre el modal

  document.getElementById("enviarBtn4").onclick = function() {
    const hora = document.getElementById("inputHora2").value;
    const destino = document.getElementById("inputDestino2").value;
    const llegada = document.getElementById("inputLlegada").value;

    if (!hora || !destino || !llegada) {
      alert("Por favor, Completa todos los campos.");
      return;
    }

    // Obtener el formulario original
    const form = document.getElementById("form4");

    // Crear y agregar input oculto para hora
    const inputHoraHidden = document.createElement("input");
    inputHoraHidden.type = "hidden";
    inputHoraHidden.name = "hora";
    inputHoraHidden.value = hora;
    form.appendChild(inputHoraHidden);

    // Crear y agregar input oculto para destino
    const inputDestinoHidden = document.createElement("input");
    inputDestinoHidden.type = "hidden";
    inputDestinoHidden.name = "destino";
    inputDestinoHidden.value = destino;
    form.appendChild(inputDestinoHidden);

    // Crear y agregar input oculto para llegada
    const inputLlegadaHidden = document.createElement("input");
    inputLlegadaHidden.type = "hidden";
    inputLlegadaHidden.name = "llegada";
    inputLlegadaHidden.value = llegada;
    form.appendChild(inputLlegadaHidden);
    // Enviar el formulario
    form.submit();
  };
}

function mostrarModal3() {
  document.getElementById("modal5").checked = true; // Abre el modal

  document.getElementById("enviarBtn5").onclick = function() {
    const hora = document.getElementById("inputHora3").value;
    const especialidad = document.getElementById("inputEspecialidad2").value;

    if (!hora || !especialidad) {
      alert("Por favor, Completa todos los campos.");
      return;
    }

    // Obtener el formulario original
    const form = document.getElementById("form5");

    // Crear y agregar input oculto para hora
    const inputHoraHidden = document.createElement("input");
    inputHoraHidden.type = "hidden";
    inputHoraHidden.name = "hora";
    inputHoraHidden.value = hora;
    form.appendChild(inputHoraHidden);

    // Crear y agregar input oculto para especialidad
    const inputEspecialidadHidden = document.createElement("input");
    inputEspecialidadHidden.type = "hidden";
    inputEspecialidadHidden.name = "especialidad";
    inputEspecialidadHidden.value = especialidad;
    form.appendChild(inputEspecialidadHidden);
    // Enviar el formulario
    form.submit();
  };
}

function mostrarModal6() {
    document.getElementById("modal2").checked = true;
  

  // Al hacer clic en "Enviar", agregar la hora seleccionada y otros datos al formulario y enviarlo
  document.getElementById("enviarBtn6").onclick = function() {
  const horaSeleccionada = document.getElementById("inputHora6").value;
  const ciudadAyudar = document.getElementById("inputCiudad6").value;

  if (!horaSeleccionada || !ciudadAyudar) {
    alert("Por favor, Completa Todos Los Campos.");
    return;
  }

  const form = document.getElementById("form2");

  const inputHora = document.createElement("input");
  inputHora.type = "hidden";
  inputHora.name = "hora";
  inputHora.value = horaSeleccionada;
  form.appendChild(inputHora); 

  const inputCiudad = document.createElement("input");
  inputCiudad.type = "hidden";
  inputCiudad.name = "ciudad";
  inputCiudad.value = ciudadAyudar;
  form.appendChild(inputCiudad); 

  form.submit();
  }
};
function mostrarModal7() {
    document.getElementById("modal3").checked = true;
  

  // Al hacer clic en "Enviar", agregar la hora seleccionada y otros datos al formulario y enviarlo
  document.getElementById("enviarBtn7").onclick = function() {
  const horaSeleccionada = document.getElementById("inputHora7").value;
  const ciudadAyudar = document.getElementById("inputCiudad7").value;

  if (!horaSeleccionada || !ciudadAyudar) {
    alert("Por favor, Completa Todos Los Campos.");
    return;
  }

  const form = document.getElementById("form3");

  const inputHora = document.createElement("input");
  inputHora.type = "hidden";
  inputHora.name = "hora";
  inputHora.value = horaSeleccionada;
  form.appendChild(inputHora); 

  const inputCiudad = document.createElement("input");
  inputCiudad.type = "hidden";
  inputCiudad.name = "ciudad";
  inputCiudad.value = ciudadAyudar;
  form.appendChild(inputCiudad); 

  form.submit();
  }
};

</script>
</html>
<?php
include 'footer_voluntario.php'
?>