<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Weapon;
use App\Models\Magazine;
use App\Models\Inventory;
use Illuminate\Support\Carbon;

class ActivitiesStatus extends Component
{
    public $activities;

    public function mount()
    {
        $this->loadActivities();
    }

    public function loadActivities()
    {
        // Cargar actividades creadas hace 5 minutos o más
        $this->activities = Activity::with(['weapon', 'magazine', 'officer'])
            ->where('created_at', '<=', Carbon::now()->subMinutes(1))
            ->get();
    }

    public function markAsDelivered($activityId)
    {
        $activity = Activity::findOrFail($activityId);

        // Actualiza el estado de las armas y magazines
        $weapon = $activity->weapon;
        $magazine = $activity->magazine;

        if ($weapon) {
            $weapon->update(['status' => 'entregado']);
        }

        if ($magazine) {
            $magazine->update(['status' => 'entregado']);
        }

        // Agrega los elementos al inventario
        Inventory::create([
            'weapon_id' => $weapon ? $weapon->id : null,
            'magazine_id' => $magazine ? $magazine->id : null,
            'officer_id' => $activity->officer_id,
        ]);

        // Recarga las actividades
        $this->loadActivities();
    }

    public function render()
    {
        return view('livewire.activities-status', [
            'activities' => $this->activities,
        ]);
    }
}
