<?php
include 'header_voluntario.php';
include '../includes/db.php';
$id = $usuario_id = $_SESSION['usuario']['id'];

    $sacardatos = $conexion->prepare("SELECT nombre, password, tonkens, insignias, valoracion, email, perfil_publico FROM usuarios WHERE id = ?");
    $sacardatos->bind_param("i", $id);
    $sacardatos->execute();
    $result = $sacardatos->get_result();
    if ($usuario = $result->fetch_assoc()) {
      $nombre =  $usuario["nombre"]; 
}
?>

<div class="carousel w-full h-[85vh]">

    <div id="slide1" class="carousel-item relative w-full">
        <img src="../img/Foto1.jpg" class="w-full object-cover" />

        <div
            class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-center text-white px-6">
            <h2 class="text-4xl md:text-5xl font-bold drop-shadow-lg">Bienvenido <?php echo $nombre ?> </h2>
            <p class="text-lg md:text-xl mt-2 mb-4 drop-shadow">Gracias por apoyar la causa </p>
            <a href="subir_producto.php" class="btn btn-wide bg-violet-700 hover:bg-violet-900 text-white">Sube tu ayuda</a>
        </div>


    </div>
</div>


<?php
include 'footer_voluntario.php';
?>