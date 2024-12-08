<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public static function validationRules()
    {
        return [
            'name' => 'required|string|max:250',
        ];
    }

}
