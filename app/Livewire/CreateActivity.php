<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Officer;
use App\Models\Weapon;
use App\Models\Magazine;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;

class CreateActivity extends Component
{
    public $officer_id;
    public $weapon_id;
    public $magazine_id;
    public $branch_id;
    public $reason;
    public $activity_id;


    protected $rules = [
        'officer_id' => 'required|exists:officers,id',
        'weapon_id' => 'required|exists:weapons,id',
        'magazine_id' => 'nullable|exists:magazines,id',
        'branch_id' => 'required|exists:branches,id',
        'reason' => 'nullable|string|max:1000',
    ];

    public function createActivity()
    {
        $this->validate();

        DB::transaction(function () {
            $officer = Officer::with('licenses')->findOrFail($this->officer_id);
            $weapon = Weapon::with('type')->findOrFail($this->weapon_id);

            $hasMatchingLicense = $officer->licenses->contains(function ($license) use ($weapon) {
                return $license->name === $weapon->type->category;
            });

            if (!$hasMatchingLicense) {
                throw new \Exception('El Officer no tiene una licencia compatible con la categoría del tipo de arma.');
            }

            if ($this->magazine_id) {
                $magazine = Magazine::findOrFail($this->magazine_id);
                if ($magazine->model_id !== $weapon->model_id) {
                    throw new \Exception('El Magazine debe ser del mismo modelo que el arma seleccionada.');
                }
            }

            if ($weapon->status !== 'disponible') {
                throw new \Exception('El arma seleccionada no está disponible.');
            }

            if ($this->magazine_id && $magazine->status !== 'disponible') {
                throw new \Exception('El Magazine seleccionado no está disponible.');
            }

            $activity = Activity::create([
                'officer_id' => $this->officer_id,
                'weapon_id' => $this->weapon_id,
                'magazine_id' => $this->magazine_id,
                'branch_id' => $this->branch_id,
                'date' => now(),
                'reason' => $this->reason,
            ]);

            $weapon->update(['status' => 'en entrega']);
            if ($this->magazine_id) {
                $magazine->update(['status' => 'en entrega']);
            }

            session()->flash('success', 'Actividad creada exitosamente.');
        });
    }

    public function deleteActivity($id)
    {
        $activity = Activity::find($id);

        if ($activity) {
            // Restaurar el estado de los recursos asociados
            $activity->weapon->update(['status' => 'disponible']);
            if ($activity->magazine) {
                $activity->magazine->update(['status' => 'disponible']);
            }

            $activity->delete();
            session()->flash('message', 'Actividad eliminada correctamente.');
        } else {
            session()->flash('error', 'No se pudo encontrar la actividad.');
        }
    }

    public function render()
    {
        return view('livewire.create-activity', [
            'officers' => Officer::all(),
            'weapons' => Weapon::where('status', 'disponible')->get(),
            'magazines' => Magazine::where('status', 'disponible')->get(),
            'branches' => Branch::all(), // Carga de las sucursales
            'activities' => Activity::with(['officer', 'weapon', 'magazine', 'branch'])->latest()->get(),
        ]);
    }
    public function returnActivity()
    {
        $activity = Activity::find($this->activity_id);

        if ($activity) {
            DB::transaction(function () use ($activity) {
                // Cambiar el estado de los recursos asociados
                $activity->weapon->update(['status' => 'disponible']);
                if ($activity->magazine) {
                    $activity->magazine->update(['status' => 'disponible']);
                }

                // Eliminar la actividad
                $activity->delete();
            });

            session()->flash('success', 'Devolución realizada correctamente. Los recursos están disponibles nuevamente.');
        } else {
            session()->flash('error', 'No se encontró la actividad especificada.');
        }
    }


}
