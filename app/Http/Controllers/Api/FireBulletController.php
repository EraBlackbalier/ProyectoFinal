<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Bullet;
use App\Http\Controllers\Controller;
use App\Models\Magazine;
use Carbon\Carbon;

class FireBulletController extends Controller
{
    public function fire(Request $request, $magazineId)
    {
        // Verificar que el magazine exista
        $magazine = Magazine::find($magazineId);

        if (!$magazine) {
            return response()->json(['error' => 'Magazine not found'], 404);
        }

        // Verificar si el magazine tiene balas no disparadas
        $bullet = $magazine->bullets()->where('status', 'chamber')->first();

        if (!$bullet) {
            return response()->json(['message' => 'No bullets available to fire'], 400);
        }

        // Marcar la bala como disparada
        $bullet->update([
            'status' => 'fired',
            'fired_date' => Carbon::now(),
        ]);

        return response()->json([
            'message' => 'Bullet fired successfully',
            'bullet' => $bullet,
        ]);
    }
}
