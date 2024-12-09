<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Officer;
use App\Models\Bullet;
use App\Models\Weapon;
use App\Models\Magazine;

class InventoryController extends Controller
{
    public function totalinventory()
    {
        // Contamos los registros de los modelos
        $officersCount = Officer::count();
        $bulletsCount = Bullet::count();
        $weaponsCount = Weapon::count();
        $magazinesCount = Magazine::count();

        // Respondemos con los conteos
        return response()->json([
            'officers_count' => $officersCount,
            'bullets_count' => $bulletsCount,
            'weapons_count' => $weaponsCount,
            'magazines_count' => $magazinesCount,
        ]);
    }
}
