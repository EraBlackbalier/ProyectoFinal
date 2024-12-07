<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'license_id',
        'id_branch',
        'id_shift',
        'division_id',
        'contact_id',
        'join_date',
    ];


    public function branch()
    {
        return $this->belongsTo(Branch::class, 'id_branch');
    }


    public function shift()
    {
        return $this->belongsTo(Shift::class, 'id_shift');
    }


    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function licenses()
    {
        return $this->belongsToMany(License::class, 'license_officer');
    }
}
