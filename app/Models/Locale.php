<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Locale extends Model
{
    protected $fillable = [
        'slug',
        'code',
        'name',
        'language_id',
        'is_active',
        'created_by',
        'deleted_by',
        'deleted_description',
    ];

    /**
     * Get the language that owns the locale.
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
