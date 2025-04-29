
//!FUNCIONES DE GESTION DE LOS SERVICIOS

function cambiarCategoria(id, categoria) {
    const formData = new FormData();
    formData.append("servicio_id", id);
    formData.append("categoria", categoria);
  
    fetch("editarCategoriaServicio.php", {
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
  
  
  function eliminarServicio(id) {
    if (!confirm("¿Seguro que deseas eliminar este servicio?")) return;
  
    const formData = new FormData();
    formData.append("servicio_id", id);
  
    fetch("eliminarServicio.php", {
      method: "POST",
      body: formData,
    })
      .then((res) => res.text())
      .then((msg) => {
        alert(msg); // Muestra el mensaje de respuesta
        location.reload();
      })
      .catch((err) => {
        console.error("Error al eliminar:", err);
        alert("No se pudo eliminar el servicio.");
      });
  }


  function cerrarPopup() {
    document.getElementById("popup").classList.add("hidden");
    location.reload(); // Recargar la página después de cerrar el popup
  }
  