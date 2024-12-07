<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeaponType extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'description',
    ];

    public static function validationRules(){
        return[
            'category'=>'string|max:250',
            'address'=>'string|max:250'
        ];
    }
}
