<div class="container mx-auto p-4 relative">
    <h1 class="text-2xl font-bold text-center mb-6">Bullet Management</h1>

    @if (!empty($reportData))
    <!-- Fondo opaco detrás del modal -->
    <div
        class="fixed inset-0 bg-black bg-opacity-50 z-40 transition-opacity duration-300"
        wire:click="$set('reportData', [])">
    </div>

    <!-- Modal -->
    <div
        class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
        bg-white rounded-lg shadow-lg p-6 w-full max-w-md z-50">
        <h3 class="text-lg font-semibold mb-4">Reporte de Bala</h3>
        <div class="space-y-2">
            <p><strong>Status:</strong> {{ $reportData['status'] }}</p>
            <p><strong>Magazine:</strong> {{ $reportData['magazine'] }}</p>
            <p><strong>Activity:</strong> {{ $reportData['activity'] }}</p>
            <p><strong>Officer:</strong> {{ $reportData['officer'] }}</p>
            <p><strong>Fired Date:</strong> {{ $reportData['fired_date'] }}</p>
        </div>
        <div class="mt-4 text-right">
            <button
                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                wire:click="$set('reportData', [])">
                Cerrar Reporte
            </button>
        </div>
    </div>
    @endif

    @if ($bulletId && $fired_date)
    <div class="bg-yellow-100 border-l-4 border-yellow-500 p-4 mb-4 rounded shadow">
        <h3 class="text-lg font-semibold">Ajustar Tiempo de Disparo</h3>
        <form wire:submit.prevent="saveAdjustedFireDate" class="space-y-4">
            <label for="fired_date" class="block font-medium">Nueva Fecha de Disparo:</label>
            <input
                type="datetime-local"
                class="border border-gray-300 rounded w-full px-2 py-1"
                wire:model="fired_date">
            @error('fired_date') <span class="text-red-500">{{ $message }}</span> @enderror
            <div class="space-x-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Guardar</button>
                <button
                    type="button"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                    wire:click="$set('bulletId', null)">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
    @endif

    <!-- Formulario de Bullet -->
    <form wire:submit.prevent="{{ $bulletId ? 'update' : 'store' }}" class="space-y-4 bg-white shadow p-6 rounded mb-6">
        <div>
            <label class="block font-medium">Caliber:</label>
            <input
                type="text"
                class="border border-gray-300 rounded w-full px-2 py-1"
                wire:model="caliber" />
            @error('caliber') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Magazine:</label>
            <select
                class="border border-gray-300 rounded w-full px-2 py-1"
                wire:model="magazine_id">
                <option value="">Select a magazine</option>
                @foreach ($magazines as $magazine)
                    <option value="{{ $magazine->id }}">{{ $magazine->model_magazine }}</option>
                @endforeach
            </select>
            @error('magazine_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <input type="hidden" wire:model="status" value="chamber" />
        <input type="hidden" wire:model="fired_date" value="" />

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            {{ $bulletId ? 'Update' : 'Add' }} Bullet
        </button>
    </form>

    <hr class="my-6" />

    <!-- Tablas separadas por Magazine -->
    @foreach ($magazines as $magazine)
        <h2 class="text-xl font-semibold mb-2">{{ $magazine->model_magazine }}</h2>
        <table class="table-auto w-full border-collapse border border-gray-300 mb-6">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Caliber</th>
                    <th class="border border-gray-300 px-4 py-2">Fired Date</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($magazine->bullets as $bullet)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $bullet->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $bullet->status }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $bullet->caliber }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $bullet->fired_date ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <div class="space-x-2">
                                <button
                                    class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600"
                                    wire:click="edit({{ $bullet->id }})">
                                    Edit
                                </button>
                                <button
                                    class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
                                    wire:click="delete({{ $bullet->id }})">
                                    Delete
                                </button>
                                <button
                                    class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600"
                                    wire:click="simulateFire({{ $bullet->id }})">
                                    Simular Disparo
                                </button>
                                <button
                                    class="bg-purple-500 text-white px-2 py-1 rounded hover:bg-purple-600"
                                    wire:click="adjustFireDate({{ $bullet->id }})">
                                    Ajustar Tiempo de Disparo
                                </button>
                                <button
                                    class="bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600"
                                    wire:click="showReport({{ $bullet->id }})">
                                    Reporte
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No bullets found for this magazine.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endforeach
</div>
