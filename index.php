<?php
include 'includes/header.php';
//include 'includes/db.php';
?>


<link rel="icon" type="image/x-icon" href="/DANA_G1/favicon.ico">

<div class="carousel w-full h-[85vh]">

    <div id="slide1" class="carousel-item relative w-full h-[85vh]">
        <img src="img/Foto1.jpg" class="w-full h-[85vh] object-cover" />

        <div
            class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-center text-white px-6">
            <h2 class="text-4xl md:text-5xl font-bold drop-shadow-lg">Bienvenido a Pueblos Unidos</h2>
            <p class="text-lg md:text-xl mt-2 mb-4 drop-shadow">El pueblo ayuda al pueblo</p>
            <a href="login.php" class="btn btn-wide bg-violet-700 hover:bg-violet-900 text-white">Iniciar Sesión</a>
        </div>

        <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
            <a href="#slide2" class="btn btn-circle">❮</a>
            <a href="#slide2" class="btn btn-circle">❯</a>
        </div>
    </div>

    <div id="slide2" class="carousel-item relative w-full h-[85vh]">
        <img src="img/Foto2.jpg" class="w-full h-[85vh] object-cover" />

        <div
            class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-center text-white px-6">
            <h2 class="text-4xl md:text-5xl font-bold drop-shadow-lg">Accede a Pueblos Unidos</h2>
            <p class="text-lg md:text-xl mt-2 mb-4 drop-shadow">Regístrate y forma parte de la familia</p>
            <a href="registro.php" class="btn btn-wide bg-violet-700 hover:bg-violet-900 text-white">Registrarse</a>
        </div>

        <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
            <a href="#slide1" class="btn btn-circle">❮</a>
            <a href="#slide1" class="btn btn-circle">❯</a>
        </div>
    </div>
</div>


<?php
include 'includes/footer.php';
?>