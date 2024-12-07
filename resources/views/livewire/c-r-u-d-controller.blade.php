<div>
    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Erroress de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario CRUD -->
    <form wire:submit.prevent="save">
        <!-- Campos de entrada dinámica según el modelo -->
        @foreach ($data as $field => $value)
        @if ($field !== 'id' && $field !== 'created_at' && $field !== 'updated_at')
            <div class="form-group">
                <x-label for="{{ $field }}">{{ ucwords(str_replace('_', ' ', $field)) }}</x-label>

                <!-- Selección de tipo de campo según el nombre y tipo del campo -->
                @if(is_numeric($value))
                    <input type="number" wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                @elseif($field === 'description')
                    <textarea wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control"></textarea>
                @elseif($field === 'reason')
                    <textarea wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control"></textarea>
                @elseif($field === 'birth_date')
                    <input type="date" wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                @elseif($field === 'join_date')
                    <input type="date" wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                @elseif($field === 'emision')
                    <input type="date" wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                @elseif($field === 'expiration')
                    <input type="date" wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                @elseif($field === 'date')
                    <input type="date" wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                @elseif($field === 'status')
                <select name="status" id="status">
                    <option value="1">Disponible</option>
                    <option value="2">En entrega</option>
                    <option value="3">No disponible</option>
                  </select>
                @else
                    <input type="text" wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                @endif
            </div>
        @endif
        @endforeach

        <!-- Botones para las operaciones CRUD -->
        <br><button class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white-800 uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-300 focus:bg-green-700 dark:focus:bg-white active:bg-green-900 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-green-800 disabled:opacity-50 transition ease-in-out duration-150" type="submit" class="btn btn-primary">
            @if ($operation === 'create')
                Crear
            @elseif ($operation === 'update')
                Actualizar
            @endif
        </button><br>

        @if ($operation === 'update')
            <x-danger-button type="button" class="btn btn-secondary" wire:click="resetForm">Cancelar</x-danger-button>
        @endif
    </form>

    <!-- Tabla de Registros -->
    <br>
    <table  class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th>ID</th>
                <!-- Encabezados dinámicos según los campos en $data -->
                @foreach (array_keys($data) as $field)
                    <th>{{ ucwords(str_replace('_', ' ', $field)) }}</th>
                @endforeach
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Listado de registros -->
            @foreach ($records as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <!-- Mostrar valores dinámicos según los campos en $data -->
                    @foreach ($data as $field => $value)
                        <td>{{ $record->$field }}</td>
                    @endforeach
                    <td>
                        <!-- Botón para editar -->
                        <button class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white-800 uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-300 focus:bg-green-700 dark:focus:bg-white active:bg-green-900 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-green-800 disabled:opacity-50 transition ease-in-out duration-150" wire:click="edit({{ $record->id }})">Editar</button>
                        <!-- Botón para eliminar -->
                        <x-danger-button class="btn btn-sm btn-danger" wire:click="delete({{ $record->id }})">Eliminar</x-danger-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
