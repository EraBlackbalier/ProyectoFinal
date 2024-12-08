<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\Officer;
use App\Models\Branch;
use App\Models\Weapon;
use App\Models\Magazine;
use App\Models\Model;
use App\Models\WeaponType;




class CRUDController extends Component
{
    use WithPagination;

    public $modelName;
    public $operation;
    public $data = [];
    public $recordId;
    public $searchTerm = '';
    public $vista = false;
    public $wtypes=[], $models = [],$officers = [], $branches =[], $weapons = [], $magazines =[];

    public function resetForm()
    {
        // Restablece los campos a null
        $this->data = array_fill_keys(array_keys($this->data), null);
        // Restablece la operación a 'create'
        $this->operation = 'create';
        // Restablece el ID del registro
        $this->recordId = null;
        // Oculta el formulario
        $this->vista = false;
    }

    public function verVista(){
        $this->vista = !$this->vista;
        if ($this->vista) {
            $this->operation = 'create';
            $this->resetForm();
            $this->vista = true; // Aseguramos que el formulario permanezca visible
        }
    }

    public function mount($modelName, $operation = 'create', $recordId = null)
    {
        unset($this->data['id'], $this->data['created_at'], $this->data['updated_at']);
        $this->modelName = ucfirst($modelName);
        $this->operation = $operation;
        $this->recordId = $recordId;

        $modelClass = 'App\\Models\\' . $this->modelName;

        if ($operation === 'update' && $recordId) {
            // Si estamos en modo actualización, cargamos los datos del registro
            $record = $modelClass::find($recordId);
            $this->data = $record ? $record->toArray() : [];
        } else {
            // Si estamos en modo creación, inicializamos $data con claves vacías para cada campo
            $this->data = array_fill_keys((new $modelClass)->getFillable(), null);
        }


        if (in_array('wtype_id', array_keys($this->data))) {
            $this->wtypes = \App\Models\WeaponType::all();
        }

        if (in_array('officer_id', array_keys($this->data))) {
            $this->officers = \App\Models\Officer::all();
        }

        if (in_array('model_id', array_keys($this->data))) {
            $this->models = \App\Models\Model::all();
        }

        if (in_array('weapon_id', array_keys($this->data))) {
            $this->weapons = \App\Models\Weapon::all();
        }

        if (in_array('magazine_id', array_keys($this->data))) {
            $this->magazines = \App\Models\Magazine::all();
        }

        if (in_array('branch_id', array_keys($this->data))) {
            $this->branches = \App\Models\Branch::all();
        }



    }

    public function save()
    {
        $modelClass = 'App\\Models\\' . $this->modelName;

        // Obtiene las reglas de validación y aplica a cada campo en $data
        $rules = [];
        foreach ($modelClass::validationRules() as $field => $rule) {
            $rules["data.$field"] = $rule;
        }

        // Aplica la validación usando las reglas ajustadas para los campos en $data
        $this->validate($rules);

        // Realiza la creación o actualización del registro
        if ($this->operation === 'create') {
            $modelClass::create($this->data);
            $message = "Registro creado exitosamente.";
        } elseif ($this->operation === 'update') {
            $record = $modelClass::find($this->recordId);
            $record->update($this->data);
            $message = "Registro actualizado exitosamente.";
        }

        // Resetea el formulario y muestra el mensaje de éxito
        session()->flash('message', $message);
        $this->resetForm();
    }

    public function edit($id)
    {
        $modelClass = 'App\\Models\\' . $this->modelName;

        // Carga el registro específico para edición
        $record = $modelClass::find($id);
        if ($record) {
            $this->data = $record->toArray();
            $this->recordId = $id;
            $this->operation = 'update';
            $this->vista = true; // Asegura que el formulario esté visible al editar
        } else {
            session()->flash('message', 'Registro no encontrado.');
        }
    }

    public function delete($id)
    {
        $modelClass = 'App\\Models\\' . $this->modelName;
        $modelClass::destroy($id);

        session()->flash('message', 'Registro eliminado exitosamente.');
    }

    public function render()
    {
        $modelClass = 'App\\Models\\' . $this->modelName;
        $records = $modelClass::where('id', 'like', '%' . $this->searchTerm . '%')->paginate(5);

        return view('livewire.c-r-u-d-controller', ['records' => $records]);
    }
}
