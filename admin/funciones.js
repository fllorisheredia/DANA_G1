
// FUNCION DE ACTUALIZAR EL CORREO DEL USUARIO


function actualizarMail(idUsuario) {
  const input = document.getElementById('email_' + idUsuario);
  const nuevoEmail = input.value;

  fetch('actualizarMail.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `id=${idUsuario}&email=${encodeURIComponent(nuevoEmail)}`
  })
    .then(response => response.text())
    .then(data => {
      alert(data);
    })
    .catch(error => {
      alert('Error al actualizar el correo');
      console.error(error);
    });
}

// FUNCION DE ACTUALIZAR EL ROL DEL USUARIO
function actualizarRol(idUsuario) {
  const input = document.getElementById('rol_' + idUsuario);
  const nuevoRol = input.value;

  fetch('actualizarRol.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `id=${idUsuario}&rol=${encodeURIComponent(nuevoRol)}`
  })
    .then(response => response.text())
    .then(data => {
      alert(data);
    })
    .catch(error => {
      alert('Error al actualizar el Rol');
      console.error(error);
    });
}



//Funcion Borrado usuario
function eliminarUsuario(idUsuario) {
  if (!confirm("¿Estás seguro de que deseas eliminar este usuario?")) return;

  fetch('borrarUsuario.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `id=${idUsuario}`
  })
    .then(response => response.text())
    .then(data => {
      alert(data);
      location.reload(); // Recarga la página para reflejar el cambio
    })
    .catch(error => {
      alert('Error al eliminar el usuario');
      console.error(error);
    });
}



 
//FUNCION ACTUALIZAR LA VALORACION DE UN USUARIO

function actualizarValoracion(idUsuario) {
  const input = document.getElementById('valoracion_' + idUsuario);
  const nuevoValor = input.value;

  fetch('actualizarValoracion.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `id=${idUsuario}&valoracion=${encodeURIComponent(nuevoValor)}`
  })
    .then(response => response.text())
    .then(data => {
      alert(data);
    })
    .catch(error => {
      alert('Error al actualizar la valoración del usuario');
      console.error(error);
    });
}


//FUNCION ACTUALIZAR LA CONTRASEÑA DE UN USUARIO

function actualizarPassword(idUsuario) {
  const input = document.getElementById('password_' + idUsuario);
  const nuevoValor = input.value;

  fetch('actualizarPassword.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `id=${idUsuario}&password=${encodeURIComponent(nuevoValor)}`
  })
    .then(response => response.text())
    .then(data => {
      alert(data);
    })
    .catch(error => {
      alert('Error al actualizar la contraseña del usuario');
      console.error(error);
    });
}






// FUNCION DE ACTUALIZAR LOS TONKENS USUARIO

function actualizarTonkens(idUsuario) {
  const input = document.getElementById('tonkens_' + idUsuario);
  const nuevoValor = input.value;

  fetch('actualizarTonkens.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `id=${idUsuario}&tonkens=${encodeURIComponent(nuevoValor)}`
  })
    .then(response => response.text())
    .then(data => {
      alert(data);
    })
    .catch(error => {
      alert('Error al actualizar los tonkens');
      console.error(error);
    });
}


// FUNCION DE MOSTRAR EL MENU DE OPCIONES

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
  const clickedMenuButton = e.target.closest("a.btn-secondary");
  const clickedMenuContent = e.target.closest("tr[id^='menu-content-']");
  if (!clickedMenuButton && !clickedMenuContent) {
    document.querySelectorAll("tr[id^='menu-content-']").forEach(menu => {
      menu.classList.add("hidden");
    });
  }
});
