<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;


    protected $fillable = [
        'officer_id',
        'name',
    ];

    public function officer()
    {
        return $this->belongsTo(Officer::class, 'officer_id');
    }
}
