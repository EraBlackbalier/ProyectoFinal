<x-app-layout>
    <div class="min-h-screen p-6 flex justify-center" style="background-image: url('https://static.vecteezy.com/system/resources/thumbnails/004/957/542/small/camouflage-seamless-pattern-for-army-and-military-free-vector.jpg');">
        <div class="bg-white rounded-xl shadow-md p-6 max-w-6xl w-full">
            <!-- Contenedor principal en dos columnas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Imagen (lado izquierdo, ocupa menos espacio horizontal) -->
                <div class="flex items-center justify-center md:col-span-1">
                    <img
                        src="https://s3-gallery.int-cdn.lcpdfrusercontent.com/monthly_2016_03/large.56f9bf968e979_AttemptedFight(Optimized).gif.48dd886cd9abba855b911a60ec64995f.gif"
                        alt="Descripción de la imagen"
                        class="rounded-lg shadow-lg object-cover w-full max-h-80"
                    />
                </div>
                <div class="md:col-span-2 flex items-center">
                    <div class="w-full">
                        @livewire('table-slider')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
