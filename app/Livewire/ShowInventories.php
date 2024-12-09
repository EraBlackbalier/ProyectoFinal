<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Officer;
use App\Models\Inventory;

class ShowInventories extends Component
{
    public $officerId;
    public $inventories = [];

    public function render()
    {
        return view('livewire.show-inventories', [
            'officers' => Officer::all(),
        ]);
    }

    public function fetchInventories()
    {
        $this->validate([
            'officerId' => 'required|exists:officers,id',
        ]);

        $this->inventories = Inventory::where('officer_id', $this->officerId)->with(['weapon', 'magazine'])->get();
    }

    public function deleteInventory($inventoryId)
    {
        $inventory = Inventory::find($inventoryId);

        if ($inventory) {
            $inventory->delete();
            $this->fetchInventories(); // Refresca la lista de inventarios después de borrar
            session()->flash('message', 'Inventario eliminado correctamente.');
        } else {
            session()->flash('error', 'El inventario no existe.');
        }
    }
}
