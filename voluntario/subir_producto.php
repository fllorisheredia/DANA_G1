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
        <h2 class="text-2xl font-bold text-green-600 mb-4">¡Producto añadido!</h2>
        <p class="text-lg">El producto ha sido agregado correctamente, Gracias por tu aportación! </p>
        <div class="modal-action">
            <label for="registroExitosoModal" class="btn btn-success">Cerrar</label>
        </div>
    </div>
</div>
<?php endif; ?>
<body>

<div class="flex gap-4 justify-center flex-wrap">

  <!-- PRODUCTO 1 -->
  <form action="subir.php" method="POST" class="card bg-base-100 w-96 shadow-sm">
  <figure class="px-10 pt-10">
    <img src="../img/kit.png" alt="Kit" class="rounded-xl w-64 h-64" />
  </figure>
  <div class="card-body items-center text-center">
    <h2 class="card-title">Kit de Limpieza</h2>
    <p>Un kit de limpieza para poder limpiar los desechos de tu hogar</p>

    <!-- Campos ocultos necesarios -->
    <input type="hidden" name="nombre" value="Kit de Limpieza">
    <input type="hidden" name="precio" value="0">

    <input type="hidden" name="categoria" value="limpieza">

    <!-- Stock visible para el usuario -->
    <label for="stock">Cantidad a agregar:</label>
    <input type="number" name="stock" min="1" value="1" required class="input input-bordered w-full max-w-xs">

    <div class="card-actions mt-2">
      <button class="btn btn-primary" type="submit">Subir</button>
    </div>
  </div>
</form>

  <!-- PRODUCTO 2 -->
  <form action="subir.php" method="POST" class="card bg-base-100 w-96 shadow-sm">
  <figure class="px-10 pt-10">
    <img src="../img/comida.png" alt="Comida" class="rounded-xl w-64 h-64" />
  </figure>
  <div class="card-body items-center text-center">
    <h2 class="card-title">Kit de alimentos</h2>
    <p>Un kit de alimentos basicos</p>

    <!-- Campos ocultos necesarios -->
    <input type="hidden" name="nombre" value="Kit alimento">
    <input type="hidden" name="precio" value="1">

    <input type="hidden" name="categoria" value="alimentos">

    <!-- Stock visible para el usuario -->
    <label for="stock">Cantidad a agregar:</label>
    <input type="number" name="stock" min="1" value="1" required class="input input-bordered w-full max-w-xs">

    <div class="card-actions mt-2">
      <button class="btn btn-primary" type="submit">Subir</button>
    </div>
  </div>
</form>

  <!-- PRODUCTO 3 -->
  <form action="subir.php" method="POST" class="card bg-base-100 w-96 shadow-sm">
  <figure class="px-10 pt-10">
    <img src="../img/servicios.jfif" alt="servicios" class="rounded-xl w-64 h-64" />
  </figure>
  <div class="card-body items-center text-center">
    <h2 class="card-title">Ofrecerse de bricolaje </h2>
    <p>Podras usar todos tus conocimientos de bricolaje para poder ayudar a los necesitados</p>

    <!-- Campos ocultos necesarios -->
    <input type="hidden" name="nombre" value="Bricolaje ">
    <input type="hidden" name="precio" value="0">

    <input type="hidden" name="categoria" value="bricolaje">

    <div class="card-actions mt-2">
      <button class="btn btn-primary" type="submit" name="stock" min="1" value="1" >Subir</button>
    </div>
  </div>
</form>


<!-- PRODUCTO 4 --> 
<form action="subir.php" method="POST" class="card bg-base-100 w-96 shadow-sm">
  <figure class="px-10 pt-10">
    <img src="../img/coche.webp" alt="transporte" class="rounded-xl w-64 h-64" />
  </figure>
  <div class="card-body items-center text-center">
    <h2 class="card-title">Ofrecerse de bricolaje </h2>
    <p>Podras usar todos tus conocimientos de bricolaje para poder ayudar a los necesitados</p>

    <!-- Campos ocultos necesarios -->
    <input type="hidden" name="nombre" value="Transporte ">
    <input type="hidden" name="precio" value="0">

    <input type="hidden" name="categoria" value="transporte">

    <div class="card-actions mt-2">
      <button class="btn btn-primary" type="submit" name="stock" min="1" value="1" >Subir</button>
    </div>
  </div>
</form>
</div>

</body>
</html>
<?php
include 'footer_voluntario.php'
?>