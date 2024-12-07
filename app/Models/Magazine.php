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
}
