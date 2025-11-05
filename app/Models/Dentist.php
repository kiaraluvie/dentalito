<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dentist extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'license_number',
        'phone',
        'is_active',
        'slug',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_description',
    ];

    /**
     * Get the user that owns the dentist profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: A dentist can have many specialties.
     */
    public function specialties()
    {
        return $this->belongsToMany(
            Specialty::class,          // Modelo relacionado
            'dentist_specialties',     // Tabla pivote
            'dentist_id',              // Clave foránea en la tabla pivote que apunta a este modelo
            'specialty_id'             // Clave foránea en la tabla pivote que apunta al modelo relacionado
        )->withTimestamps();
    }

    /**
     * Scope a query to only include dentists based on request filters.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $request)
    {
        // Filtrar por especialidad (usando la relación ahora)
        if ($request->filled('specialty')) {
            $query->whereHas('specialties', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->specialty . '%');
            });
        }

        // Filtrar por nombre del usuario
        if ($request->filled('first_name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->first_name . '%');
            });
        }

        // Filtrar por email
        if ($request->filled('email')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->email . '%');
            });
        }

        return $query;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
