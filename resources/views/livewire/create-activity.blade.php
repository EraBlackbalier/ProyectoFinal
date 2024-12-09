<div class="max-w-7xl mx-auto p-6 bg-gray-100 rounded-lg shadow-md">
    <!-- Formulario para crear actividades -->
    <form wire:submit.prevent="createActivity" class="space-y-6 bg-white p-6 rounded-lg shadow-sm">
        <h2 class="text-xl font-semibold text-gray-800">Crear Actividad</h2>

        <div class="space-y-4">
            <div>
                <label for="officer_id" class="block text-sm font-medium text-gray-700">Officer</label>
                <select wire:model="officer_id" id="officer_id" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Seleccionar</option>
                    @foreach($officers as $officer)
                        <option value="{{ $officer->id }}">{{ $officer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="weapon_id" class="block text-sm font-medium text-gray-700">Weapon</label>
                <select wire:model="weapon_id" id="weapon_id" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Seleccionar</option>
                    @foreach($weapons as $weapon)
                        <option value="{{ $weapon->id }}">{{ $weapon->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="magazine_id" class="block text-sm font-medium text-gray-700">Magazine</label>
                <select wire:model="magazine_id" id="magazine_id" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Seleccionar</option>
                    @foreach($magazines as $magazine)
                        <option value="{{ $magazine->id }}">{{ $magazine->model_magazine }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="branch_id" class="block text-sm font-medium text-gray-700">Sucursal</label>
                <select wire:model="branch_id" id="branch_id" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Selecciona una Sucursal</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
                <textarea wire:model="reason" id="reason" class="form-textarea mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
            </div>
        </div>

        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Crear Actividad
        </button>
    </form>

    <!-- Tabla de actividades -->
    <div class="mt-8">
        <h2 class="text-xl font-semibold text-gray-800">Lista de Actividades</h2>
        <table class="min-w-full bg-white border border-gray-200 mt-4 rounded-lg shadow-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700">ID</th>
                    <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700">Oficial</th>
                    <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700">Arma</th>
                    <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700">Cartucho</th>
                    <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700">Sucursal</th>
                    <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700">Fecha</th>
                    <th class="border px-4 py-2 text-left text-sm font-medium text-gray-700">Motivo</th>
                    <th class="border px-4 py-2 text-center text-sm font-medium text-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $activity)
                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="border px-4 py-2">{{ $activity->id }}</td>
                        <td class="border px-4 py-2">{{ $activity->officer->name ?? 'Sin Oficial' }}</td>
                        <td class="border px-4 py-2">{{ $activity->weapon->nombre ?? 'Sin Arma' }}</td>
                        <td class="border px-4 py-2">{{ $activity->magazine->model_magazine ?? 'Sin Revista' }}</td>
                        <td class="border px-4 py-2">{{ $activity->branch->name ?? 'Sin Sucursal' }}</td>
                        <td class="border px-4 py-2">{{ $activity->date }}</td>
                        <td class="border px-4 py-2">{{ $activity->reason ?? 'Sin Motivo' }}</td>
                        <td class="border px-4 py-2 text-center">
                            <button
                                wire:click="deleteActivity({{ $activity->id }})"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded"
                            >
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-8 bg-white p-6 rounded-lg shadow-sm">
        <h2 class="text-xl font-semibold text-gray-800">Devolver Actividad</h2>
        <form wire:submit.prevent="returnActivity" class="space-y-4">
            <div>
                <label for="activity_id" class="block text-sm font-medium text-gray-700">Seleccionar Actividad</label>
                <select id="activity_id" wire:model="activity_id" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Seleccione una actividad</option>
                    @foreach($activities as $activity)
                        <option value="{{ $activity->id }}">{{ $activity->id }} - {{ $activity->weapon->name }} ({{ $activity->officer->name }})</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Devolver
            </button>
        </form>
    </div>
</div>
