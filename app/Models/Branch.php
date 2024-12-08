<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
    ];

    public function officers()
    {
        return $this->hasMany(Officer::class, 'id_branch');
    }

    public static function validationRules()
    {
        return [
            'name' => 'required|string|max:250', // Nombre de la sucursal
            'location' => 'required|string|max:500', // Ubicación de la sucursal
        ];
    }
}
