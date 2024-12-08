<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_id',
        'nombre',
        'wtype_id',
        'status',
    ];

    public function type()
    {
        return $this->belongsTo(WeaponType::class, 'wtype_id');
    }

    public function model()
    {
        return $this->belongsTo(Model::class, 'model_id');
    }

    public static function validationRules()
    {
        return [
            'nombre' => 'required|string|max:250',
            'model_id' => 'required|string|max:250',
            'wtype_id' => 'required|exists:weapon_types,id',
            'status' => 'required|string|max:50',
        ];
    }
}
