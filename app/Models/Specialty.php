<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    public function dentists()
    {
        return $this->belongsToMany(Dentist::class, 'dentist_specialties', 'specialty_id', 'dentist_id')
                    ->withTimestamps();
    }

}
