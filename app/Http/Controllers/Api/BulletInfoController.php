<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Bullet;
use App\Models\Activity;
use App\Http\Controllers\Controller;
use App\Models\Magazine;

class BulletInfoController extends Controller
{
    public function getBulletInfo($bulletId)
    {
        // Buscar la bala por ID
        $bullet = Bullet::find($bulletId);

        if (!$bullet) {
            return response()->json(['error' => 'Bullet not found'], 404);
        }

        // Verificar que la bala fue disparada
        if ($bullet->status !== 'fired') {
            return response()->json(['message' => 'Bullet has not been fired'], 400);
        }

        // Obtener el magazine relacionado
        $magazine = $bullet->magazine;

        if (!$magazine) {
            return response()->json(['error' => 'Magazine not found'], 404);
        }

        // Buscar la actividad que involucra el magazine
        $activity = $magazine->activities()->latest('date')->first();

        if (!$activity) {
            return response()->json(['error' => 'No activity found for this magazine'], 404);
        }

        // Obtener detalles del oficial y del arma
        $officer = $activity->officer;
        $weapon = $activity->weapon;

        // Generar el mensaje
        $message = "La bala {$bullet->id} del cargador {$magazine->id} del arma {$weapon->nombre} del oficial {$officer->name} ha sido disparada el {$bullet->fired_date}.";

        return response($message);
    }
}
