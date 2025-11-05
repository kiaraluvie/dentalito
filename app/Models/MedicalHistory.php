<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalHistory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'patient_id',
        'allergies',
        'chronic_diseases',
        'medications',
        'surgical_history',
        'family_history',
        'observations',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_description',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
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
