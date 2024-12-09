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

       <div>
           <x-input class="w-1/3 border-gray-600 placeholder:text-gray-300" placeholder="Buscar..." wire:model.live='searchTerm'/>
           <x-button wire:click="verVista">Crear</x-button>
       </div>
       @if ($vista)
           <!-- Formulario CRUD -->
           <form wire:submit.prevent="save">
            @foreach ($data as $field => $value)
                @if ($field !== 'id' && $field !== 'created_at' && $field !== 'updated_at')
                    <div class="form-group">
                        <x-label for="{{ $field }}">{{ ucwords(str_replace('_', ' ', $field)) }}</x-label>

                        @if ($field === 'officer_id')
                            <!-- Relación con Officer -->
                            <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                                <option value="">Selecciona un Oficial</option>
                                @foreach ($officers as $officer)
                                    <option value="{{ $officer->id }}" @if($officer->id == $value) selected @endif>
                                        {{ $officer->name }}
                                    </option>
                                @endforeach
                            </select>
                        @elseif ($field === 'weapon_id')
                            <!-- Relación con Weapon -->
                            <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                                <option value="">Selecciona un Arma</option>
                                @foreach ($weapons as $weapon)
                                    <option value="{{ $weapon->id }}" @if($weapon->id == $value) selected @endif>
                                        {{ $weapon->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        @elseif ($field === 'model_id')
                            <!-- Relación con Weapon -->
                            <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                                <option value="">Selecciona un modelo de arma</option>
                                @foreach ($models as $model)
                                    <option value="{{ $model->id }}" @if($model->id == $value) selected @endif>
                                        {{ $model->name }}
                                    </option>
                                @endforeach
                            </select>
                        @elseif ($field === 'magazine_id')
                            <!-- Relación con Magazine -->
                            <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                                <option value="">Selecciona un Cargador</option>
                                @foreach ($magazines as $magazine)
                                    <option value="{{ $magazine->id }}" @if($magazine->id == $value) selected @endif>
                                        {{ $magazine->model_magazine }}
                                    </option>
                                @endforeach
                            </select>
                        @elseif ($field === 'wtype_id')
                            <!-- Relación con Magazine -->
                            <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                                <option value="">Selecciona un tipo de arma</option>
                                @foreach ($wtypes as $wtype)
                                    <option value="{{ $wtype->id }}" @if($wtype->id == $value) selected @endif>
                                        {{ $wtype->category }}
                                    </option>
                                @endforeach
                            </select>
                        @elseif ($field === 'branch_id')
                            <!-- Relación con Branch -->
                            <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                                <option value="">Selecciona una Sucursal</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}" @if($branch->id == $value) selected @endif>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        @elseif ($field === 'date')
                            <!-- Campo de Fecha -->
                            <input type="date" wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                        @elseif ($field === 'reason')
                            <!-- Campo de Texto -->
                            <textarea wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control"></textarea>
                        @elseif ($field === 'location')
                            <!-- Campo de Texto para ubicación de Branch -->
                            <input type="text" wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                        @elseif ($field === 'status')
                            <!-- Select para el campo status -->
                            <select wire:model.defer="data.{{ $field }}" id="{{ $field }}" class="form-control">
                                <option>Selecciona la disponibilidad</option>
                                <option value="disponible" @if($value === 'disponible') selected @endif>Disponible</option>
                                <option value="no disponible" @if($value === 'no disponible') selected @endif>No Disponible</option>
                            </select>
                        @else
                            <!-- Campo Genérico -->
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
       @endif


       <!-- Tabla de Registros -->
       <br>
       <table  class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
           <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
               <tr>
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
       {{ $records->links() }}
   </div>
