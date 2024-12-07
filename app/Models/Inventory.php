<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'weapon_id',
        'magazine_id',
        'bullet_id',
        'officer_id',
    ];


    public function weapon()
    {
        return $this->belongsTo(Weapon::class, 'weapon_id', 'code');
    }


    public function magazine()
    {
        return $this->belongsTo(Magazine::class, 'magazine_id', 'code');
    }


    public function bullet()
    {
        return $this->belongsTo(Bullet::class, 'bullet_id', 'id');
    }


    public function officer()
    {
        return $this->belongsTo(Officer::class, 'officer_id');
    }
}
