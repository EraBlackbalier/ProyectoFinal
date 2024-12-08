<div class="container mt-5">
    <h2 class="mb-4 text-center text-primary fw-bold">Gestión de Officers</h2>

    <!-- Mensajes de sesión -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded" role="alert">
            <strong>¡Éxito!</strong> {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded" role="alert">
            <strong>¡Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Botón para abrir el modal de creación -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <button class="btn btn-primary btn-lg shadow rounded-pill" wire:click="set('modal',true)" data-bs-toggle="modal" data-bs-target="#officerModal">
            Crear
        </button>
    </div>

    <!-- Tabla de Officers -->
    <div class="table-responsive shadow rounded bg-white p-3">
        <table class="table table-striped align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Sucursal</th>
                    <th>Turno</th>
                    <th>División</th>
                    <th>Fecha de Ingreso</th>
                    <th>Licencias</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($officers as $officer)
                    <tr>
                        <td>{{ $officer->id }}</td>
                        <td>{{ $officer->name }}</td>
                        <td>{{ $officer->branch->name ?? 'Sin sucursal' }}</td>
                        <td>{{ $officer->shift->name ?? 'Sin turno' }}</td>
                        <td>{{ $officer->division->name ?? 'Sin división' }}</td>
                        <td>{{ $officer->join_date }}</td>
                        <td>
                            @forelse($officer->licenses as $license)
                                <span class="badge bg-success">{{ $license->name }}</span>
                            @empty
                                <span class="text-muted">Sin licencias</span>
                            @endforelse
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info shadow-sm rounded-pill"  wire:click="edit({{ $officer->id }})" data-bs-toggle="modal" data-bs-target="#officerModal">
                                Editar
                            </button>
                            <button class="btn btn-sm btn-danger shadow-sm rounded-pill" wire:click="delete({{ $officer->id }})">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted fst-italic">No hay Officers disponibles</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $officers->links() }}
    </div>

    @if($modal)
        <!-- Modal para Crear/Editar Officer -->
        <div wire:ignore.self class="modal fade" id="officerModal" tabindex="-1" aria-labelledby="officerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content shadow-lg rounded">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="officerModalLabel">
                            {{ $isEditMode ? 'Editar Officer' : 'Agregar Nuevo Officer' }}
                        </h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label fw-bold">Nombre</label>
                                        <input type="text" id="name" class="form-control shadow-sm" wire:model.defer="name" placeholder="Ingrese el nombre">
                                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="id_branch" class="form-label fw-bold">Sucursal</label>
                                        <select id="id_branch" class="form-select shadow-sm" wire:model.defer="id_branch">
                                            <option value="">Seleccione una sucursal</option>
                                            @foreach($branches as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_branch') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-bold">Correo Electrónico</label>
                                        <input type="email" id="email" class="form-control shadow-sm" wire:model.defer="email" placeholder="Ingrese el correo electrónico">
                                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label fw-bold">Teléfono</label>
                                        <input type="text" id="phone" class="form-control shadow-sm" wire:model.defer="phone" placeholder="Ingrese el teléfono">
                                        @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="curp" class="form-label fw-bold">CURP</label>
                                        <input type="text" id="curp" class="form-control shadow-sm" wire:model.defer="curp" placeholder="Ingrese el CURP (opcional)">
                                        @error('curp') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="birthday" class="form-label fw-bold">Fecha de Nacimiento</label>
                                        <input type="date" id="birthday" class="form-control shadow-sm" wire:model.defer="birthday">
                                        @error('birthday') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="id_shift" class="form-label fw-bold">Turno</label>
                                        <select id="id_shift" class="form-select shadow-sm" wire:model.defer="id_shift">
                                            <option value="">Seleccione un turno</option>
                                            @foreach($shifts as $shift)
                                                <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_shift') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="division_id" class="form-label fw-bold">División</label>
                                        <select id="division_id" class="form-select shadow-sm" wire:model.defer="division_id">
                                            <option value="">Seleccione una división</option>
                                            @foreach($divisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('division_id') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="join_date" class="form-label fw-bold">Fecha de Ingreso</label>
                                        <input type="date" id="join_date" class="form-control shadow-sm" wire:model.defer="join_date">
                                        @error('join_date') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Licencias</label>
                                        <div>
                                            @foreach($licenses as $license)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $license->id }}"
                                                        wire:model.defer="selectedLicenses"
                                                        id="license_{{ $license->id }}">
                                                    <label class="form-check-label" for="license_{{ $license->id }}">
                                                        {{ $license->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('selectedLicenses') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary shadow-sm mt-3">{{ $isEditMode ? 'Actualizar' : 'Guardar' }}</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="set('modal',false)" class="btn btn-secondary shadow-sm" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>