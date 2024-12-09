<div>
    <h2 class="text-xl font-bold mb-4">Estado de Actividades</h2>

    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">Oficial</th>
                <th class="border border-gray-300 px-4 py-2">Arma</th>
                <th class="border border-gray-300 px-4 py-2">Cargador</th>
                <th class="border border-gray-300 px-4 py-2">Estado</th>
                <th class="border border-gray-300 px-4 py-2">Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($activities as $activity)
                <tr class="{{ $loop->even ? 'bg-gray-100' : '' }}">
                    <td class="border border-gray-300 px-4 py-2">{{ $activity->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $activity->officer->name ?? 'N/A' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $activity->weapon->nombre ?? 'N/A' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $activity->magazine->model_magazine ?? 'N/A' }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $activity->weapon?->status === 'entregado' && $activity->magazine?->status === 'entregado' ? 'Registrado' : 'Pendiente' }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        @if ($activity->weapon?->status !== 'entregado' || $activity->magazine?->status !== 'entregado')
                            <button
                                wire:click="markAsDelivered({{ $activity->id }})"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                            >
                                Registrar
                            </button>
                        @else
                            <span class="text-green-500 font-bold">Registrado</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center border border-gray-300 px-4 py-2">No hay actividades recientes.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
