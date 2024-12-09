<div>
    <div class="mb-4">
        <label for="officer" class="block font-bold text-gray-700">Selecciona un Oficial</label>
        <select id="officer" wire:model="officerId" class="border rounded w-full p-2">
            <option value="">-- Selecciona --</option>
            @foreach($officers as $officer)
                <option value="{{ $officer->id }}">{{ $officer->name }}</option>
            @endforeach
        </select>
    </div>

    <button wire:click="fetchInventories" class="bg-blue-500 text-white px-4 py-2 rounded">
        Ver Inventarios
    </button>

    <div class="mt-6">
        @if (session()->has('message'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if(!empty($inventories))
            <h3 class="font-bold text-lg">Inventarios Relacionados</h3>
            <table class="table-auto w-full mt-4 border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Arma</th>
                        <th class="border px-4 py-2">Revista</th>
                        <th class="border px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $inventory)
                        <tr>
                            <td class="border px-4 py-2">{{ $inventory->id }}</td>
                            <td class="border px-4 py-2">{{ $inventory->weapon->nombre ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">{{ $inventory->magazine->model_magazine ?? 'N/A' }}</td>
                            <td class="border px-4 py-2 text-center">
                                <button wire:click="deleteInventory({{ $inventory->id }})"
                                    class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">No hay inventarios para el oficial seleccionado.</p>
        @endif
    </div>
</div>
