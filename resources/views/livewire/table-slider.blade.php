<div>
    <div class="relative w-full max-w-4xl mx-auto overflow-hidden">
        <!-- Botones de navegación -->
    </div>
    <div class="flex flex-wrap justify-center space-x-4 mt-6">
        <button
            wire:click="$set('currentSlide', 0)"
            class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-400 focus:outline-none transition mb-2"
        >
            Weapon
        </button>
        <button
            wire:click="$set('currentSlide', 1)"
            class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-400 focus:outline-none transition mb-2"
        >
            Branch
        </button>
        <button
            wire:click="$set('currentSlide', 2)"
            class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-400 focus:outline-none transition mb-2"
        >
            Division
        </button>
        <button
            wire:click="$set('currentSlide', 3)"
            class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-400 focus:outline-none transition mb-2"
        >
            License
        </button>
        <button
            wire:click="$set('currentSlide', 4)"
            class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-400 focus:outline-none transition mb-2"
        >
            Magazine
        </button>
        <button
            wire:click="$set('currentSlide', 5)"
            class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-400 focus:outline-none transition mb-2"
        >
            Model
        </button>
        <button
            wire:click="$set('currentSlide', 6)"
            class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-400 focus:outline-none transition mb-2"
        >
            Shift
        </button>
        <button
            wire:click="$set('currentSlide', 7)"
            class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-400 focus:outline-none transition mb-2"
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
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
        <button
        wire:click="previous"
        class=""
    >
        ‹
    </button>

        @foreach ($slides as $index => $slide)
            <div
                class="w-3 h-3 rounded-full {{ $index === $currentSlide ? 'bg-blue-500' : 'bg-gray-400' }}"
            ></div>
        @endforeach
        <button
        wire:click="next"
        class=""
    >
        ›
    </button>
    </div>
</div>
