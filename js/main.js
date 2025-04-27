// 2main.js
// Cargar vistas dinámicamente (desde dentro de iframe)

/* Archivo JavaScript para validaciones y funciones interactivas */
document.addEventListener("DOMContentLoaded", function () {
    console.log("JavaScript cargado correctamente");

    // Validación de formularios
    document.querySelectorAll("form").forEach(form => {
        form.addEventListener("submit", function (event) {
            let valido = true;
            form.querySelectorAll("input[required]").forEach(input => {
                if (!input.value.trim()) {
                    valido = false;
                    input.style.border = "2px solid red";
                } else {
                    input.style.border = "";
                }
            });
            if (!valido) {
                event.preventDefault();
                alert("Por favor, completa todos los campos obligatorios.");
            }
        });
    });

    // Función para agregar productos al carrito (simulado en localStorage)
    document.querySelectorAll(".agregar-carrito").forEach(boton => {
        boton.addEventListener("click", function () {
            let productoId = this.dataset.id;
            let carrito = JSON.parse(localStorage.getItem("carrito")) || {};
            carrito[productoId] = (carrito[productoId] || 0) + 1;
            localStorage.setItem("carrito", JSON.stringify(carrito));
            alert("Producto agregado al carrito");
        });
    });

    // Mostrar el contenido del carrito en la página carrito.php
    if (document.getElementById("contenido-carrito")) {
        let carrito = JSON.parse(localStorage.getItem("carrito")) || {};
        let lista = "";
        for (let id in carrito) {
            lista += `<p>Producto ID: ${id} - Cantidad: ${carrito[id]}</p>`;
        }
        document.getElementById("contenido-carrito").innerHTML = lista || "<p>El carrito está vacío.</p>";
    }
});

//!FUNCION PARA EL CAMBIO ENTRE MODO OSCURO Y CLARO


    function toggleTheme() {
        const html = document.documentElement;
        const currentTheme = html.getAttribute("data-theme") || "light";
        const newTheme = currentTheme === "dark" ? "light" : "dark";

        html.setAttribute("data-theme", newTheme);
        localStorage.setItem("theme", newTheme);

        const icon = document.getElementById("theme-icon");
        icon.textContent = newTheme === "dark" ? "☀️" : "🌙";
    }

    // guardamos la seleccion en el localStorage
    document.addEventListener("DOMContentLoaded", () => {
        const savedTheme = localStorage.getItem("theme") || "light";
        document.documentElement.setAttribute("data-theme", savedTheme);
        document.getElementById("theme-icon").textContent = savedTheme === "dark" ? "☀️" : "🌙";
    });