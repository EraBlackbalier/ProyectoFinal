<?php

namespace App\Livewire;

use App\Models\Officer;
use App\Models\Branch;
use App\Models\Shift;
use App\Models\Division;
use App\Models\License;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class OfficerController extends Component
{
    use WithPagination;

    public $officerId;
    public $name, $id_branch, $id_shift, $division_id, $join_date, $email, $phone, $curp, $birthday;
    public $selectedLicenses = [];
    public $isEditMode = false;
    public $modal;

    protected $paginationTheme = 'bootstrap';

    public function rules()
    {
        return Officer::validationRules() + [
            'selectedLicenses' => 'array',
            'selectedLicenses.*' => 'exists:licenses,id',
        ];
    }

    public function mount()
    {
        $this->resetFields();
    }

    public function render()
    {
        return view('livewire.officer-controller', [
            'officers' => Officer::with(['branch', 'shift', 'division', 'licenses'])->paginate(10),
            'branches' => Branch::all(),
            'shifts' => Shift::all(),
            'divisions' => Division::all(),
            'licenses' => License::all(),
        ]);
    }

    public function resetFields()
    {
        $this->fill([
            'officerId' => null,
            'name' => '',
            'id_branch' => null,
            'id_shift' => null,
            'division_id' => null,
            'join_date' => '',
            'email' => '',
            'phone' => '',
            'curp' => '',
            'birthday' => '',
            'selectedLicenses' => [],
            'isEditMode' => false,
        ]);
    }

    public function store()
    {
        $this->validate();

        try {
            $officer = Officer::create([
                'name' => $this->name,
                'id_branch' => $this->id_branch,
                'id_shift' => $this->id_shift,
                'division_id' => $this->division_id,
                'join_date' => $this->join_date,
                'email' => $this->email,
                'phone' => $this->phone,
                'curp' => $this->curp,
                'birthday' => $this->birthday,
            ]);

            $officer->licenses()->sync($this->selectedLicenses);

            session()->flash('message', 'Officer creado exitosamente.');
            $this->resetFields();
        } catch (\Exception $e) {
            Log::error('Error al crear Officer: ' . $e->getMessage());
            session()->flash('error', 'Hubo un problema al crear el Officer.');
        }
    }

    public function edit($id)
    {
        try {
            $this->isEditMode = true;
            $officer = Officer::findOrFail($id);

            $this->fill([
                'officerId' => $officer->id,
                'name' => $officer->name,
                'id_branch' => $officer->id_branch,
                'id_shift' => $officer->id_shift,
                'division_id' => $officer->division_id,
                'join_date' => $officer->join_date,
                'email' => $officer->email,
                'phone' => $officer->phone,
                'curp' => $officer->curp,
                'birthday' => $officer->birthday,
                'selectedLicenses' => $officer->licenses->pluck('id')->toArray(),
            ]);
        } catch (\Exception $e) {
            Log::error('Error al editar Officer: ' . $e->getMessage());
            session()->flash('error', 'No se pudo cargar el Officer para edición.');
        }
        $this->modal = true;
    }

    public function update()
    {
        $this->validate();

        try {
            $officer = Officer::findOrFail($this->officerId);

            $officer->update([
                'name' => $this->name,
                'id_branch' => $this->id_branch,
                'id_shift' => $this->id_shift,
                'division_id' => $this->division_id,
                'join_date' => $this->join_date,
                'email' => $this->email,
                'phone' => $this->phone,
                'curp' => $this->curp,
                'birthday' => $this->birthday,
            ]);

            $officer->licenses()->sync($this->selectedLicenses);

            session()->flash('message', 'Officer actualizado exitosamente.');
            $this->resetFields();
        } catch (\Exception $e) {
            Log::error('Error al actualizar Officer: ' . $e->getMessage());
            session()->flash('error', 'Hubo un problema al actualizar el Officer.');
        }
    }

    public function delete($id)
    {
        try {
            $officer = Officer::findOrFail($id);
            $officer->licenses()->detach();
            $officer->delete();

            session()->flash('message', 'Officer eliminado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar Officer: ' . $e->getMessage());
            session()->flash('error', 'No se pudo eliminar el Officer.');
        }
    }
}
