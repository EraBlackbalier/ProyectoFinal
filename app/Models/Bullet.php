<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bullet extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'caliber',
        'fired_date',
        'magazine_id',
    ];

    public function magazine()
    {
        return $this->belongsTo(Magazine::class, 'magazine_id');
    }
}
