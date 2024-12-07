<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'phone',
        'curp',
        'birthday',
    ];

    public function officer()
    {
        return $this->hasOne(Officer::class, 'contact_id');
    }
}
