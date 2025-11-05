<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'dentist_id',
        'appointment_date',
        'start_time',
        'end_time',
        'reason',
        'status',
        'notes',
        'is_active',
        'slug',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_description',
    ];

    /**
     * Get the patient that owns the appointment.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the dentist that owns the appointment.
     */
    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
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
