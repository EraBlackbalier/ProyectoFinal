<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bullet extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'caliber',
        'fired_date',
        'magazine_id',
    ];


    public function magazine()
    {
        return $this->belongsTo(Magazine::class, 'magazine_id');
    }

    public static function validationRules()
    {
        return [
            'status' => 'required|string|max:50', // Estado del proyectil
            'caliber' => 'required|string|max:50', // Calibre
            'fired_date' => 'nullable|date', // Fecha opcional en formato válido
            'magazine_id' => 'nullable|exists:magazines,id',
        ];
    }
}
