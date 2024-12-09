<div class="min-h-screen p-6 flex items-center justify-center" style="background-image: url('https://static.vecteezy.com/system/resources/thumbnails/004/957/542/small/camouflage-seamless-pattern-for-army-and-military-free-vector.jpg')">
    <div class="bg-white rounded-xl shadow-md p-6 max-w-6xl w-full">
        <!-- Título -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-green-600">
                Gestión de Actividades y Estado
            </h1>
        </div>

        <!-- Contenedor principal -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Imagen (parte superior, ocupa toda la fila en pantallas pequeñas) -->
            <div class="md:col-span-3">
                <img
                    src="https://img.gta5-mods.com/q95/images/improved-vanilla-lspd-male-cops-los-santos-police-department/5829a5-20191212014832_1.jpg"
                    alt="Descripción de la imagen"
                    class="rounded-lg shadow-lg object-cover w-full max-h-80"
                />
            </div>

            <!-- Componente Create Activity (bloque central) -->
            <div class="bg-gray-100 p-4 rounded-lg shadow-sm md:col-span-3">
                @livewire('create-activity')
            </div>

            <!-- Bloque paralelo con una imagen al lado -->
            <div class="md:col-span-2 bg-gray-100 p-4 rounded-lg shadow-sm">
                @livewire('activities-status')
            </div>
            <div class="flex items-center justify-center">
                <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQqU3pfrnmt-fHSRb4LWuo5UBESdRDXE49kLQ&s"
                    alt="Descripción de la imagen"
                    class="rounded-lg shadow-lg object-cover w-full max-h-80"
                />
            </div>
        </div>
    </div>
</div>
