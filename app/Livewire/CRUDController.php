<?php

namespace App\Livewire;

use App\Models\Model;
use Livewire\Component;

class CRUDController extends Component
{
    public $modelName;
    public $operation;
    public $data = [];
    public $recordId;

    // Dentro de la clase CRUDController

public function resetForm()
{
    // Restablece los campos a null
    $this->data = array_fill_keys(array_keys($this->data), null);
    // Restablece la operación a 'create'
    $this->operation = 'create';
    // Restablece el ID del registro
    $this->recordId = null;
}


    public function mount($modelName, $operation = 'create', $recordId = null)
{
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
     // Elimina los campos no editables (ID y fechas)
    unset($this->data['id'], $this->data['created_at'], $this->data['updated_at']);
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
    } elseif ($this->operation === 'update') {
        $record = $modelClass::find($this->recordId);
        $record->update($this->data);
    }

    // Resetea el formulario y muestra el mensaje de éxito
    session()->flash('message', "Registro {$this->operation} exitosamente.");
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
        $records = $modelClass::all();

        return view('livewire.c-r-u-d-controller', ['records' => $records]);
    }
}
