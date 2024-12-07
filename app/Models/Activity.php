<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

     protected $fillable = [
        'officer_id',
        'weapon_id',
        'magazine_id',
        'branch_id',
        'date',
        'reason',
    ];


    public function officer()
    {
        return $this->belongsTo(Officer::class, 'officer_id');
    }


    public function weapon()
    {
        return $this->belongsTo(Weapon::class, 'weapon_id', 'code');
    }


    public function magazine()
    {
        return $this->belongsTo(Magazine::class, 'magazine_id', 'code');
    }


    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
