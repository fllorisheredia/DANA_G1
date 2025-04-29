function toggleMenu(id) {
    // Ocultar todos los menús menos el que corresponde
    document.querySelectorAll("tr[id^='menu-content-']").forEach((menu) => {
      if (menu.id !== `menu-content-${id}`) {
        menu.classList.add("hidden");
      }
    });
  
    // Alternar (toggle) el menú actual
    const menuActual = document.getElementById(`menu-content-${id}`);
    if (menuActual) {
      menuActual.classList.toggle("hidden");
    }
  }