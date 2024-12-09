<div>
    <div class="relative w-full max-w-4xl mx-auto overflow-hidden">
        <!-- Botones de navegación -->
    </div>
    <div class="flex flex-wrap justify-center space-x-4 mt-6">
        <button
            wire:click="$set('currentSlide', 0)"
            class="px-4 py-2 bg-gray-500 text-white rounded-full hover:bg-green-400 focus:outline-none transition mb-2"
        >
            Weapon
        </button>
        <button
            wire:click="$set('currentSlide', 1)"
            class="px-4 py-2 bg-gray-500 text-white rounded-full hover:bg-green-400 focus:outline-none transition mb-2"
        >
            Branch
        </button>
        <button
            wire:click="$set('currentSlide', 2)"
            class="px-4 py-2 bg-gray-500 text-white rounded-full hover:bg-green-400 focus:outline-none transition mb-2"
        >
            Division
        </button>
        <button
            wire:click="$set('currentSlide', 3)"
            class="px-4 py-2 bg-gray-500 text-white rounded-full hover:bg-green-400 focus:outline-none transition mb-2"
        >
            License
        </button>
        <button
            wire:click="$set('currentSlide', 4)"
            class="px-4 py-2 bg-gray-500 text-white rounded-full hover:bg-green-400 focus:outline-none transition mb-2"
        >
            Magazine
        </button>
        <button
            wire:click="$set('currentSlide', 5)"
            class="px-4 py-2 bg-gray-500 text-white rounded-full hover:bg-green-400 focus:outline-none transition mb-2"
        >
            Model
        </button>
        <button
            wire:click="$set('currentSlide', 6)"
            class="px-4 py-2 bg-gray-500 text-white rounded-full hover:bg-green-400 focus:outline-none transition mb-2"
        >
            Shift
        </button>
        <button
            wire:click="$set('currentSlide', 7)"
            class="px-4 py-2 bg-gray-500 text-white rounded-full hover:bg-green-400 focus:outline-none transition mb-2"
        >
            WeaponType
        </button>
    </div>

    <div class="mt-6">
        <!-- Título dinámico según el modelo que se muestra -->
        <div class="pl-12">
            @if($currentSlide === 0)
                <h2 class="text-3xl font-semibold text-gray-800">Weapon</h2>
                @livewire('c-r-u-d-controller', ['modelName' => 'Weapon'])
            @elseif($currentSlide === 1)
                <h2 class="text-3xl font-semibold text-gray-800">Branch</h2>
                @livewire('c-r-u-d-controller', ['modelName' => 'Branch'])
            @elseif($currentSlide === 2)
                <h2 class="text-3xl font-semibold text-gray-800">Division</h2>
                @livewire('c-r-u-d-controller', ['modelName' => 'Division'])
            @elseif($currentSlide === 3)
                <h2 class="text-3xl font-semibold text-gray-800">License</h2>
                @livewire('c-r-u-d-controller', ['modelName' => 'License'])
            @elseif($currentSlide === 4)
                <h2 class="text-3xl font-semibold text-gray-800">Magazine</h2>
                @livewire('c-r-u-d-controller', ['modelName' => 'Magazine'])
            @elseif($currentSlide === 5)
                <h2 class="text-3xl font-semibold text-gray-800">Model</h2>
                @livewire('c-r-u-d-controller', ['modelName' => 'Model'])
            @elseif($currentSlide === 6)
                <h2 class="text-3xl font-semibold text-gray-800">Shift</h2>
                @livewire('c-r-u-d-controller', ['modelName' => 'Shift'])
            @elseif($currentSlide === 7)
                <h2 class="text-3xl font-semibold text-gray-800">WeaponType</h2>
                @livewire('c-r-u-d-controller', ['modelName' => 'WeaponType'])
            @endif
        </div>
    </div>

    <!-- Indicadores -->
    <div class="flex items-center justify-center space-x-4 py-4">
        <!-- Botón Anterior -->
        <button
            wire:click="previous"
            class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700 transition ease-in-out shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            aria-label="Anterior"
        >
            ‹
        </button>

        <!-- Indicadores de Slides -->
        <div class="flex space-x-2">
            @foreach ($slides as $index => $slide)
                <div
                    class="w-4 h-4 rounded-full transition-all duration-300 {{ $index === $currentSlide ? 'bg-green-500 scale-110 shadow-md' : 'bg-gray-300' }}"
                ></div>
            @endforeach
        </div>

        <!-- Botón Siguiente -->
        <button
            wire:click="next"
            class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700 transition ease-in-out shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            aria-label="Siguiente"
        >
            ›
        </button>
    </div>

    </div>
</div>
