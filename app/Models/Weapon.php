<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    use HasFactory;
    protected $fillable = [
        'model',
        'wtype_id',
        'status',
    ];

    public function type()
    {
        return $this->belongsTo(WeaponType::class, 'wtype_id');
    }
}
