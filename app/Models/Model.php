<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'image',
        'supplier',
        'name',
    ];

    public static function validationRules()
    {
        return [
            'image' => 'nullable|string|max:250', // Ruta o nombre de imagen
            'supplier' => 'nullable|string|max:250', // Nombre del proveedor
            'name' => 'required|string|max:250', // Nombre del modelo
        ];
    }

    public function weapon()
    {
        return $this->hasMany(Weapon::class, 'weapon_id');
    }
}
