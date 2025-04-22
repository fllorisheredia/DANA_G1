<?php
include '../includes/header.php';
include '../includes/db.php';
?>

<main class="min-h-screen bg-base-100 py-12 px-4 md:px-12 lg:px-24">
    <section class="max-w-4xl mx-auto bg-white rounded-xl shadow-xl border-l-4 border-violet-800 p-10 space-y-8">
        <h1 class="text-4xl font-extrabold text-center text-violet-800 tracking-tight mb-6">
            Aviso Legal
        </h1>

        <p class="text-lg text-gray-800 text-justify leading-relaxed">
            Este sitio web ha sido desarrollado como parte de un <strong>proyecto académico del ciclo de Desarrollo de
                Aplicaciones Multiplataforma (DAM)</strong>. Toda la información que se muestra tiene fines
            exclusivamente educativos y de simulación.
        </p>

        <div class="space-y-6">
            <div>
                <h2 class="text-2xl font-semibold text-violet-700 mb-2">1. Titularidad del sitio</h2>
                <p class="text-gray-800 text-justify">
                    Este sitio es una simulación educativa y no representa una entidad jurídica o profesional real. Su
                    objetivo es recrear el funcionamiento de una tienda online para prácticas formativas.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-violet-700 mb-2">2. Propiedad intelectual</h2>
                <p class="text-gray-800 text-justify">
                    Los contenidos utilizados son de carácter demostrativo. Si se detectara la infracción de derechos de
                    autor, serán retirados a la mayor brevedad.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-violet-700 mb-2">3. Responsabilidad del contenido</h2>
                <p class="text-gray-800 text-justify">
                    No nos hacemos responsables del uso real de la información publicada. Cualquier similitud con sitios
                    reales es coincidencia o simulación.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-violet-700 mb-2">4. Normativa aplicable</h2>
                <p class="text-gray-800 text-justify">
                    Este ejemplo académico tiene en cuenta las principales normativas como el RGPD, LOPDGDD, LSSI-CE y
                    la Ley de Propiedad Intelectual, con fines puramente ilustrativos.
                </p>
            </div>
        </div>
    </section>
</main>

<?php
include '../includes/footer.php';
?>