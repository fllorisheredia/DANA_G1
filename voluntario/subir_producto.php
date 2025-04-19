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
<body>

<div class="flex gap-4 justify-center flex-wrap">

  <!-- PRODUCTO 1 -->
  <form action="subir_producto.php" method="POST" class="card bg-base-100 w-96 shadow-sm">
    <figure class="px-10 pt-10">
      <img src="../img/kit.png" alt="Kit" class="rounded-xl w-64 h-64" />
    </figure>
    <div class="card-body items-center text-center">
      <h2 class="card-title">Kit de Limpieza</h2>
      <p>Un kit de limpieza para poder limpiar los desechos de tu hogar</p>
      <input type="hidden" name="nombre" value="Kit de Limpieza">
      <input type="hidden" name="descripcion" value="Un kit de limpieza para poder limpiar los desechos de tu hogar">
      <input type="hidden" name="precio" value="0.00">
      <input type="hidden" name="cantidad" value="1">
      <div class="card-actions">
        <button class="btn btn-primary" type="submit">Subir</button>
      </div>
    </div>
  </form>

  <!-- PRODUCTO 2 -->
  <form action="subir_producto.php" method="POST" class="card bg-base-100 w-96 shadow-sm">
    <figure class="px-10 pt-10">
      <img src="../img/comida.png" alt="Kit" class="rounded-xl w-64 h-64" />
    </figure>
    <div class="card-body items-center text-center">
      <h2 class="card-title">Kit de Alimentos</h2>
      <p>Un kit de alimentos básicos.</p>
      <input type="hidden" name="nombre" value="Kit de Alimentos">
      <input type="hidden" name="descripcion" value="Un kit de alimentos básicos.">
      <input type="hidden" name="precio" value="0.00">
      <input type="hidden" name="cantidad" value="1">
      <div class="card-actions">
        <button class="btn btn-primary" type="submit">Subir</button>
      </div>
    </div>
  </form>

  <!-- PRODUCTO 3 -->
  <form action="subir_producto.php" method="POST" class="card bg-base-100 w-96 shadow-sm">
    <figure class="px-10 pt-10">
      <img src="../img/servicios.jfif" alt="Kit" class="rounded-xl w-90 h-64" />
    </figure>
    <div class="card-body items-center text-center">
      <h2 class="card-title">Kit de Servicios</h2>
      <p>Un kit de limpieza para poder limpiar los desechos de tu hogar (como Mikhail)</p>
      <input type="hidden" name="nombre" value="Kit de Servicios">
      <input type="hidden" name="descripcion" value="Un kit de limpieza para poder limpiar los desechos de tu hogar (como Mikhail)">
      <input type="hidden" name="precio" value="0.00">
      <input type="hidden" name="cantidad" value="1">
      <div class="card-actions">
        <button class="btn btn-primary" type="submit">Subir</button>
      </div>
    </div>
  </form>

</div>

</body>
</html>
<?php
include 'footer_voluntario.php'
?>