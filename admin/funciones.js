//!FUNCIONES DE GESTION DEL USUARIO

// FUNCION DE ACTUALIZAR EL CORREO DEL USUARIO
function actualizarMail(idUsuario) {
  const input = document.getElementById("email_" + idUsuario);
  const nuevoEmail = input.value;

  fetch("actualizarMail.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `id=${idUsuario}&email=${encodeURIComponent(nuevoEmail)}`,
  })
    .then((response) => response.text())
    .then((data) => {
      alert(data);
      location.reload();
    })
    .catch((error) => {
      alert("Error al actualizar el correo");
      console.error(error);
    });
}

// FUNCION DE ACTUALIZAR EL ROL DEL USUARIO
function actualizarRol(idUsuario) {
  const input = document.getElementById("rol_" + idUsuario);
  const nuevoRol = input.value;

  fetch("actualizarRol.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `id=${idUsuario}&rol=${encodeURIComponent(nuevoRol)}`,
  })
    .then((response) => response.text())
    .then((data) => {
      alert(data);
      location.reload();
    })
    .catch((error) => {
      alert("Error al actualizar el Rol");
      console.error(error);
    });
}

//Funcion Borrado usuario
function eliminarUsuario(idUsuario) {
  if (!confirm("¿Estás seguro de que deseas eliminar este usuario?")) return;

  fetch("borrarUsuario.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `id=${idUsuario}`,
  })
    .then((response) => response.text())
    .then((data) => {
      alert(data);
      location.reload(); // Recarga la página para reflejar el cambio
    })
    .catch((error) => {
      alert("Error al eliminar el usuario");
      console.error(error);
    });
}

//FUNCION ACTUALIZAR LA VALORACION DE UN USUARIO

function actualizarValoracion(idUsuario) {
  const input = document.getElementById("valoracion_" + idUsuario);
  const nuevoValor = input.value;

  fetch("actualizarValoracion.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `id=${idUsuario}&valoracion=${encodeURIComponent(nuevoValor)}`,
  })
    .then((response) => response.text())
    .then((data) => {
      alert(data);
      location.reload();
    })
    .catch((error) => {
      alert("Error al actualizar la valoración del usuario");
      console.error(error);
    });
}

//FUNCION ACTUALIZAR LA CONTRASEÑA DE UN USUARIO

function actualizarPassword(idUsuario) {
  const input = document.getElementById("password_" + idUsuario);
  const nuevoValor = input.value;

  fetch("actualizarPassword.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `id=${idUsuario}&password=${encodeURIComponent(nuevoValor)}`,
  })
    .then((response) => response.text())
    .then((data) => {
      alert(data);
      location.reload();
    })
    .catch((error) => {
      alert("Error al actualizar la contraseña del usuario");
      console.error(error);
    });
}

// FUNCION DE ACTUALIZAR LOS TONKENS USUARIO

function actualizarTonkens(idUsuario) {
  const input = document.getElementById("tonkens_" + idUsuario);
  const nuevoValor = input.value;

  fetch("actualizarTonkens.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `id=${idUsuario}&tonkens=${encodeURIComponent(nuevoValor)}`,
  })
    .then((response) => response.text())
    .then((data) => {
      alert(data);
      location.reload();
    })
    .catch((error) => {
      alert("Error al actualizar los tonkens");
      console.error(error);
    });
}

// FUNCION DE MOSTRAR EL MENU DE OPCIONES

function toggleMenu(id) {
  document.querySelectorAll("tr[id^='menu-content-']").forEach((menu) => {
    if (menu.id !== `menu-content-${id}`) {
      menu.classList.add("hidden");
    }
  });

  const menu = document.getElementById(`menu-content-${id}`);
  menu.classList.toggle("hidden");
}

document.addEventListener("click", function (e) {
  const clickedMenuButton = e.target.closest("a.btn-secondary");
  const clickedMenuContent = e.target.closest("tr[id^='menu-content-']");
  if (!clickedMenuButton && !clickedMenuContent) {
    document.querySelectorAll("tr[id^='menu-content-']").forEach((menu) => {
      menu.classList.add("hidden");
    });
  }
});

//!FUNCIONES DE GESTION DE LOS PEDIDOS

{
  /* <script> */
}
function actualizarEstado(pedidoId) {
  const select = document.getElementById(`estado-${pedidoId}`);
  const nuevoEstado = select.value;

  const formData = new FormData();
  formData.append("pedido_id", pedidoId);
  formData.append("estado", nuevoEstado);

  fetch("editar_pedido.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.text())
    .then((response) => {
      if (response === "ok") {
        alert("Estado actualizado correctamente.");
      } else {
        alert("Error al actualizar el estado.");
      }
    })
    .catch((err) => {
      console.error(err);
      alert("Error de conexión al actualizar el estado.");
    });
}

function eliminarPedido(pedidoId) {
  if (!confirm("¿Estás seguro de que deseas eliminar este pedido?")) return;

  fetch(`eliminar_pedido.php?id=${pedidoId}`)
    .then((res) => res.text())
    .then((response) => {
      if (response === "ok") {
        alert("Pedido eliminado correctamente.");
        // Ocultar o quitar el pedido del DOM
        const card = document.getElementById(`pedido-card-${pedidoId}`);
        if (card) card.remove();
      } else {
        alert("Error al eliminar el pedido.");
      }
    })
    .catch((err) => {
      console.error(err);
      alert("Error de conexión al eliminar el pedido.");
    });
}
// </script>

// //CERRAR SESION
// document.getElementById('btnCerrarSesion').addEventListener('click', function () {
//   fetch('../includes/cerrar_sesion.php', {
//       method: 'GET'
//   })
//   .then(response => {
//       if (response.redirected) {
//           // Si PHP redirige, llevamos al usuario allí (normalmente a index.php)
//           window.location.href = response.url;
//       } else {
//           // Por si quieres mostrar un mensaje sin redirigir
//           alert("Sesión cerrada.");
//       }
//   })
//   .catch(error => {
//       console.error('Error cerrando sesión:', error);
//       alert("Hubo un error al cerrar la sesión.");
//   });
// });

//!FUNCIONES DE GESTION DE PRODUCTOS
function eliminarProducto(id) {
  if (!confirm("¿Estás seguro de que deseas eliminar este producto?")) {
    return;
  }

  const formData = new FormData();
  formData.append("id", id);

  fetch("eliminar_producto.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      alert(data);
      location.reload();
      if (data.includes("✅ Producto eliminado correctamente")) {
        document.getElementById(`producto-${id}`).remove();
      }
    })
    .catch((error) => {
      console.error("Error al eliminar el producto:", error);
    });
}

document.addEventListener("DOMContentLoaded", function () {
  const btn = document.getElementById("btnCerrarSesion");
  if (btn) {
    btn.addEventListener("click", function () {
      fetch("../includes/cerrar_sesion.php") // ← Asegúrate de que esta ruta es válida
        .then((response) => {
          if (response.redirected) {
            window.location.href = response.url;
          } else {
            window.location.href = "../index.php";
          }
        })
        .catch((error) => {
          console.error("Error cerrando sesión:", error);
          alert("Hubo un error al cerrar la sesión.");
        });
    });
  }
});

//!FUNCIONES PARA ACTUALIZAR LAS COSAS DE LOS PRODUCTOS

function toggleMenu2(id) {
  const menu = document.getElementById(`menu-${id}`);
  if (menu) menu.classList.toggle("hidden");
}

function guardarProducto(event, id) {
  event.preventDefault();
  const form = event.target;
  const formData = new FormData(form);

  fetch("", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.text())
    .then((res) => {
      if (res.trim() === "ok") {
        // Mostrar popup de éxito
        document.getElementById("popup").classList.remove("hidden");
      } else {
        alert("Error al actualizar");
      }
    });
}

function cerrarPopup() {
  document.getElementById("popup").classList.add("hidden");
  location.reload(); // Recargar la página después de cerrar el popup
}

function cambiarEstado(id, estado) {
  const formData = new FormData();
  formData.append("pedido_id", id);
  formData.append("estado", estado);

  fetch("editar_pedido.php", {
    method: "POST",
    body: formData,
  }).then((res) => {
    if (res.ok) {
      document.getElementById("popup").classList.remove("hidden");
    } else {
      alert("Error al actualizar el estado.");
    }
  });
}

function eliminarPedido(id) {
  if (confirm("¿Seguro que deseas eliminar este pedido?")) {
    window.location.href = "eliminar_pedido.php?id=" + id;
  }
}
