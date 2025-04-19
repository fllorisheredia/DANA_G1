<?php
include 'includes/header.php';
include 'includes/db.php';





?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Subir Producto</title>
</head>
<body>


<div class="flex gap-4 justify-center flex-wrap">
  <div class="card bg-base-100 w-96 shadow-sm">
    <figure class="px-10 pt-10">
      <img src="img/kit.png" alt="Kit" class="rounded-xl w-64 h-64" />
    </figure>
    <div class="card-body items-center text-center">
      <h2 class="card-title">Kit de Limpieza</h2>
      <p>Un kit de limpieza para poder limpiar los desechos de tu hogar</p>
      <div class="card-actions">
        <button class="btn btn-primary"  action="solicitar.php" method="POST" >Subir </button>
      </div>
    </div>
  </div>

  <div class="card bg-base-100 w-96 shadow-sm">
    <figure class="px-10 pt-10">
      <img src="img/comida.png" alt="Kit" class="rounded-xl w-64 h-64" />
    </figure>
    <div class="card-body items-center text-center">
      <h2 class="card-title">Kit de alimentos</h2>
      <p>Un kit de alimentos basicos.</p>
      <div class="card-actions">
        <button class="btn btn-primary">Subir</button>
      </div>
    </div>
  </div>

  <div class="card bg-base-100 w-96 shadow-sm">
    <figure class="px-10 pt-10">
      <img src="img/servicios.jfif" alt="Kit" class="rounded-xl w-90 h-64" />
    </figure>
    <div class="card-body items-center text-center">
      <h2 class="card-title">Kit de Limpieza</h2>
      <p>Un kit de limpieza para poder limpiar los desechos de tu hogar (como mikhail)</p>
      <div class="card-actions">
        <button class="btn btn-primary">Subir</button>
      </div>
    </div>
  </div>
</div>


</body>
</html>