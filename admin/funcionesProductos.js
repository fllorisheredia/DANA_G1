


//!FUNCIONES DE GESTION DE PRODUCTOS
function eliminarProducto(idProducto) {
    if (!confirm("¿Estás seguro de que deseas eliminar este producto?")) return;
  
    fetch('borrarProducto.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `id=${idProducto}`
    })
      .then(response => response.text())
      .then(data => {
        alert(data);
        location.reload(); 
      })
      .catch(error => {
        alert('❌ Error al eliminar el producto');
        console.error(error);
      });
  }
  