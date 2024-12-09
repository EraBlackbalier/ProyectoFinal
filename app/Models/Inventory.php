<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'weapon_id',
        'magazine_id',
        'officer_id',
    ];

    public function weapon()
    {
        return $this->belongsTo(Weapon::class, 'weapon_id', 'id');
    }


    public function magazine()
    {
        return $this->belongsTo(Magazine::class, 'magazine_id', 'id');
    }


    public function officer()
    {
        return $this->belongsTo(Officer::class, 'officer_id');
    }

    public static function validationRules()
    {
        return [
            'weapon_id' => 'required|exists:weapons,code', // Clave foránea con código de arma
            'magazine_id' => 'nullable|exists:magazines,code', // Clave foránea opcional
            'officer_id' => 'nullable|exists:officers,id', // Clave foránea opcional
        ];
    }
}
