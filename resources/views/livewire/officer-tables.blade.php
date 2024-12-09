<div class="min-h-screen p-6 flex items-center justify-center" style="background-image: url('https://static.vecteezy.com/system/resources/thumbnails/004/957/542/small/camouflage-seamless-pattern-for-army-and-military-free-vector.jpg'">
    <div class="bg-white rounded-xl shadow-md p-6 max-w-6xl w-full">
        <!-- Título -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-green-600">
                Gestión de Inventarios y Oficiales
            </h1>
        </div>

        <!-- Contenedor principal -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Imagen (lado izquierdo, ocupa menos espacio horizontal) -->
            <div class="flex items-center justify-center md:col-span-1">
                <img
                    src="https://cdn.mos.cms.futurecdn.net/6h3mriQNq38LjeE2xRPA88.jpg"
                    alt="Descripción de la imagen"
                    class="rounded-lg shadow-lg object-cover w-full max-h-80"
                />
            </div>

            <!-- Secciones Livewire (lado derecho, ocupa más espacio horizontal) -->
            <div class="md:col-span-2 space-y-6">
                <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                    @livewire('show-inventories')
                </div>
                <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                    @livewire('officer-controller')
                </div>
            </div>
        </div>
    </div>
</div>
