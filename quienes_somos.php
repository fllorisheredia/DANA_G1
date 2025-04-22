<?php
include 'includes/header.php';
include 'includes/db.php';
?>

<main class="min-h-screen bg-base-100 flex items-center justify-center px-4">
    <article
        class="bg-white dark:bg-neutral rounded-3xl shadow-2xl p-10 max-w-4xl w-full space-y-6 border border-gray-200 dark:border-gray-700 transition-all duration-300">

        <div class="flex justify-center">
            <div class="flex justify-center mx-auto">
                <img class="w-auto sm:h-20" src="img/logoSinF.png" alt="Logo">
            </div>
        </div>

        <h1 class="text-4xl font-extrabold text-center text-violet-700 tracking-tight">¿Quiénes somos?</h1>

        <div class="space-y-4 text-neutral text-lg leading-relaxed text-justify">
            <p>
                Somos una organización comprometida con brindar ayuda a las víctimas de la <strong>DANA</strong>.
                Nuestra misión es ofrecer apoyo, recursos y soluciones tecnológicas para facilitar la recuperación de
                las comunidades afectadas.
            </p>

            <p>
                Con un equipo dedicado de profesionales y voluntarios, trabajamos para crear herramientas digitales
                que mejoren la respuesta ante emergencias y fortalezcan la solidaridad entre las personas.
            </p>
        </div>

    </article>
</main>

<?php
include 'includes/footer.php';
?>