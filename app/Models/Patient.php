<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'slug',
        'is_active',
        'name',
        'lastname',
        'photo',
        'dni',
        'sex',
        'birth_date',
        'age',
        'phone',
        'email',
        'address',
        'occupation',
        'marital_status',
        'blood_type',
        'emergency_contact_name',
        'emergency_contact_phone',
        'allergies',
        'chronic_diseases',
        'medications',
        'surgical_history',
        'family_history',
        'observations',
        'locale_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_description',
    ];

    /**
     * Get the tenant that owns the patient.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the locale that owns the patient.
     */
    public function locale(): BelongsTo
    {
        return $this->belongsTo(Locale::class);
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
    public function medicalHistory()
    {
        return $this->hasOne(\App\Models\MedicalHistory::class);
    }
}
