<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Bullet;
use App\Models\Magazine;

class BulletCrud extends Component
{
    public $bullets = [];
    public $magazines = [];
    public $bulletId;
    public $caliber, $magazine_id;
    public $status = 'chamber';
    public $fired_date = null;
    public $reportData = [];


public function simulateFire($id)
{
    $bullet = Bullet::findOrFail($id);
    $bullet->update([
        'status' => 'fired',
        'fired_date' => now(),
    ]);

    $this->loadData();
    session()->flash('message', 'Bullet fired successfully.');
}

public function adjustFireDate($id)
{
    $this->bulletId = $id;
    $this->fired_date = Bullet::findOrFail($id)->fired_date;
}

public function saveAdjustedFireDate()
{
    $bullet = Bullet::findOrFail($this->bulletId);
    $bullet->update(['fired_date' => $this->fired_date]);

    $this->resetForm();
    $this->loadData();
    session()->flash('message', 'Fired date updated successfully.');
}

public function showReport($id)
{
    // Carga la relación con el magazine, su actividad (múltiples si es hasMany) y el oficial de la actividad
    $bullet = Bullet::with('magazine.activities.officer')->findOrFail($id);

    // Verifica si hay actividades asociadas al magazine
    $activity = $bullet->magazine->activities->first(); // Obtiene la primera actividad si existe

    // Si hay actividad, obtiene la información del oficial, si no hay actividad, asigna valores por defecto
    $officer = $activity ? $activity->officer : null; // Obtiene el oficial si existe, si no asigna null

    $this->reportData = [
        'status' => $bullet->status,
        'magazine' => $bullet->magazine->model_magazine ?? 'N/A',
        'activity' => $activity ? $activity->reason : 'No activity assigned', // Si no hay actividad, mostrar mensaje
        'officer' => $officer ? $officer->name : 'No officer assigned', // Si no hay oficial, mostrar mensaje
        'fired_date' => $bullet->fired_date ?? 'Not fired', // Si no hay fired_date, mostrar mensaje
    ];
}



    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
{
    $this->magazines = Magazine::with('bullets')->get();
}


    public function resetForm()
    {
        $this->bulletId = null;
        $this->status = '';
        $this->caliber = '';
        $this->fired_date = null;
        $this->magazine_id = null;
    }

    public function store()
{
    // Validar los datos
    $data = $this->validate([
        'caliber' => 'required|string|max:50',
        'magazine_id' => 'required|exists:magazines,id',
    ]);

    // Agregar valores predeterminados
    $data['status'] = 'chamber';
    $data['fired_date'] = null;

    // Crear la bala
    Bullet::create($data);

    // Actualizar la vista y resetear el formulario
    $this->loadData();
    $this->resetForm();

    // Mensaje de éxito
    session()->flash('message', 'Bullet created successfully.');
}


    public function edit($id)
    {
        $bullet = Bullet::findOrFail($id);
        $this->bulletId = $bullet->id;
        $this->status = $bullet->status;
        $this->caliber = $bullet->caliber;
        $this->fired_date = $bullet->fired_date;
        $this->magazine_id = $bullet->magazine_id;
    }

    public function update()
    {
        $this->validate(Bullet::validationRules());

        $bullet = Bullet::findOrFail($this->bulletId);
        $bullet->update([
            'status' => $this->status,
            'caliber' => $this->caliber,
            'fired_date' => $this->fired_date,
            'magazine_id' => $this->magazine_id,
        ]);

        $this->loadData();
        session()->flash('message', 'Bullet updated successfully.');
    }

    public function delete($id)
    {
        Bullet::findOrFail($id)->delete();
        $this->loadData();
        session()->flash('message', 'Bullet deleted successfully.');
    }

    public function render()
    {
        return view('livewire.bullet-crud');
    }

}
