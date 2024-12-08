<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
    ];

    public function officers()
    {
        return $this->belongsToMany(Officer::class, 'license_officer');
    }

    public static function validationRules()
    {
        return [
            'name' => 'required|string|max:250',
        ];
    }
}
