<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];


    public function officers()
    {
        return $this->hasMany(Officer::class, 'division_id');
    }

    public static function validationRules()
    {
        return [
            'name' => 'required|string|max:250', // Nombre de la división
            'description' => 'nullable|string|max:1000', // Descripción opcional
        ];
    }
}
