<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use HasFactory;

      protected $fillable = [
        'caliber',
        'capacity',
        'model_id',
        'model_magazine',
        'in_stock',
    ];

    public function bullets()
    {
        return $this->hasMany(Bullet::class, 'magazine_id');
    }

    public function model()
    {
        return $this->belongsTo(Model::class, 'model_id');
    }

    public static function validationRules()
    {
        return [
            'caliber' => 'required|string|max:50', // Calibre
            'capacity' => 'required|integer|min:1', // Capacidad mínima 1
            'model_id' => 'required|exists:models,id', // Relación con Model
            'model_magazine' => 'nullable|string|max:250', // Modelo de revista
            'in_stock' => 'required', // Si está en stock (0 o 1)
        ];
    }
}
