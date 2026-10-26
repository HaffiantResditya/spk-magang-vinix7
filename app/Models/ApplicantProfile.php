<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicantProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'institution',
        'phone',
        'cv_path',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the accessible URL for the CV document (Cloudinary HTTPS or local storage).
     */
    public function getCvUrlAttribute(): ?string
    {
        if (empty($this->cv_path)) {
            return null;
        }

        if (str_starts_with($this->cv_path, 'http://') || str_starts_with($this->cv_path, 'https://')) {
            return $this->cv_path;
        }

        return asset('storage/' . $this->cv_path);
    }
}
