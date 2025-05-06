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
    const origen = document.getElementById("inputOrigen").value;
    const destino = document.getElementById("inputDestino").value;

    const form = document.getElementById("form4");

    // Limpiar inputs ocultos anteriores (por si se reabre el modal)
    ["hora", "origen", "destino"].forEach((name) => {
      const existing = form.querySelector(`input[name="${name}"]`);
      if (existing) form.removeChild(existing);
    });

    // Crear y agregar inputs ocultos con los nuevos valores
    const inputHoraHidden = document.createElement("input");
    inputHoraHidden.type = "hidden";
    inputHoraHidden.name = "hora";
    inputHoraHidden.value = hora;
    form.appendChild(inputHoraHidden);

    const inputOrigenHidden = document.createElement("input");
    inputOrigenHidden.type = "hidden";
    inputOrigenHidden.name = "origen";
    inputOrigenHidden.value = origen;
    form.appendChild(inputOrigenHidden);

    const inputDestinoHidden = document.createElement("input");
    inputDestinoHidden.type = "hidden";
    inputDestinoHidden.name = "destino";
    inputDestinoHidden.value = destino;
    form.appendChild(inputDestinoHidden);

    form.submit();
  };
}

function mostrarModal3() {
  document.getElementById("modal5").checked = true; 

  document.getElementById("enviarBtn5").onclick = function () {
    const hora = document.getElementById("inputHora3").value;
    const especialidad = document.getElementById("inputEspecialidad2").value;
    const ciudadAyudar = document.getElementById("inputDestino32").value; 

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

  document.getElementById("enviarBtn7").onclick = function () {
    const horaSeleccionada = document.getElementById("inputHora7").value;
    const ciudadAyudar = document.getElementById("inputCiudad7").value;

  
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
