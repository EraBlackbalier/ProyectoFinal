<x-app-layout>
    <div class="min-h-screen p-6 flex items-center justify-center" style="background-image: url('https://static.vecteezy.com/system/resources/thumbnails/004/957/542/small/camouflage-seamless-pattern-for-army-and-military-free-vector.jpg')">
        <div class="bg-white rounded-xl shadow-md p-6 max-w-6xl w-full">
            <!-- Título -->
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-green-600">
                    Gestión de Datos con Imagen Representativa
                </h1>
            </div>

            <!-- Contenedor principal -->
            <div class="grid grid-cols-1 gap-6">
                <!-- Imagen (parte superior, ocupa toda la fila) -->
                <div class="flex items-center justify-center">
                    <img
                        src="https://media.invisioncic.com/o315288/monthly_2023_06/JA3_DevDiary_GunsGunsGuns_02.jpg.00e67f3c3f4860871b4422b44f6b4e66.jpg"
                        alt="Imagen decorativa"
                        class="rounded-lg shadow-lg object-cover w-full max-h-80"
                    />
                </div>

                <!-- Tabla (parte inferior) -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        @livewire('bullet-crud')
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
