<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_branch',
        'id_shift',
        'division_id',
        'join_date',
        'email',
        'phone',
        'curp',
        'birthday',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'id_branch');
    }

    public function inventory()
    {
        return $this->hasOne(Branch::class, 'id_');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'id_shift');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }


    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function licenses()
    {
        return $this->belongsToMany(License::class, 'license_officer');
    }

    public static function validationRules()
    {
        return [
            'name' => 'required|string|max:250',
            'id_branch' => 'required|exists:branches,id',
            'id_shift' => 'required|exists:shifts,id',
            'division_id' => 'required|exists:divisions,id',
            'join_date' => 'required|date',
            'email' => 'required|email|max:250', // Correo válido
            'phone' => 'required|string|max:15', // Teléfono con longitud máxima
            'curp' => 'nullable|string|size:18', // CURP con longitud exacta de 18
            'birthday' => 'nullable|date', // Fecha de nacimiento válida
        ];
    }
}
