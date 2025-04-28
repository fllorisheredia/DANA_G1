// Mostrar el modal al activar el botón de "Ofrecerse"
function mostrarModal() {
  document.getElementById("modal1").checked = true;

  document.getElementById("enviarBtn").onclick = function () {
    const horaSeleccionada = document.getElementById("inputHora").value;
    const ciudadAyudar = document.getElementById("inputCiudad").value;

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
  };
}

function mostrarModal2() {
  document.getElementById("modal4").checked = true; // Abre el modal

  document.getElementById("enviarBtn4").onclick = function () {
    const hora = document.getElementById("inputHora2").value;
    const destino = document.getElementById("inputDestino2").value;
    const llegada = document.getElementById("inputLlegada").value;

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

  document.getElementById("enviarBtn5").onclick = function () {
    const hora = document.getElementById("inputHora3").value;
    const especialidad = document.getElementById("inputEspecialidad2").value;
    const ciudadAyudar = document.getElementById("inputDestino32").value; // Corregir el error tipográfico

    // Obtener el formulario original
    const form = document.getElementById("form5");

    // Crear y agregar input oculto para ciudad
    const inputCiudad = document.createElement("input");
    inputCiudad.type = "hidden";
    inputCiudad.name = "ciudad";
    inputCiudad.value = ciudadAyudar;
    form.appendChild(inputCiudad);

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

  document.getElementById("enviarBtn6").onclick = function () {
    const horaSeleccionada = document.getElementById("inputHora6").value;
    const ciudadAyudar = document.getElementById("inputCiudad6").value;

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
  };
}

function mostrarModal7() {
  document.getElementById("modal3").checked = true;

  // Al hacer clic en "Enviar", agregar la hora seleccionada y otros datos al formulario y enviarlo
  document.getElementById("enviarBtn7").onclick = function () {
    const horaSeleccionada = document.getElementById("inputHora7").value;
    const ciudadAyudar = document.getElementById("inputCiudad7").value;

    // Crear el formulario oculto para enviar los datos
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
  };
}
