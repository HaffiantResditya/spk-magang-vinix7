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
     * Get the raw unmodified CV URL or path (e.g. original .pdf file).
     */
    public function getRawCvUrlAttribute(): ?string
    {
        if (empty($this->cv_path)) {
            return null;
        }

        if (str_starts_with($this->cv_path, 'http://') || str_starts_with($this->cv_path, 'https://')) {
            return $this->cv_path;
        }

        return asset('storage/' . $this->cv_path);
    }

    /**
     * Get the accessible URL for the CV document (Cloudinary HTTPS or local storage).
     * Cloudinary blocks direct public delivery of .pdf files on free accounts with 401 ACL failure,
     * so Cloudinary PDF URLs are safely converted to high-resolution rendered .jpg format.
     */
    public function getCvUrlAttribute(): ?string
    {
        if (empty($this->cv_path)) {
            return null;
        }

        if (str_starts_with($this->cv_path, 'http://') || str_starts_with($this->cv_path, 'https://')) {
            if (str_contains($this->cv_path, 'res.cloudinary.com') && str_ends_with(strtolower($this->cv_path), '.pdf')) {
                return substr($this->cv_path, 0, -4) . '.jpg';
            }
            return $this->cv_path;
        }

        return asset('storage/' . $this->cv_path);
    }

    /**
     * Get the accessible preview image URL (converts Cloudinary .pdf to .jpg to bypass ACL restriction).
     */
    public function getCvPreviewUrlAttribute(): ?string
    {
        if (empty($this->cv_path)) {
            return null;
        }

        if (str_starts_with($this->cv_path, 'http://') || str_starts_with($this->cv_path, 'https://')) {
            if (str_ends_with(strtolower($this->cv_path), '.pdf')) {
                return substr($this->cv_path, 0, -4) . '.jpg';
            }
            return $this->cv_path;
        }

        return asset('storage/' . $this->cv_path);
    }

    /**
     * Get page URLs for multi-page document preview (supports up to 5 pages from Cloudinary).
     */
    public function getCvPagesAttribute(): array
    {
        if (empty($this->cv_path)) {
            return [];
        }

        if (str_starts_with($this->cv_path, 'http://') || str_starts_with($this->cv_path, 'https://')) {
            if (str_contains($this->cv_path, 'res.cloudinary.com') && str_ends_with(strtolower($this->cv_path), '.pdf')) {
                $pages = [];
                for ($i = 1; $i <= 5; $i++) {
                    $pageUrl = preg_replace('#/image/upload/(v\d+/)#', "/image/upload/pg_{$i}/$1", $this->cv_path);
                    $pageUrl = preg_replace('#\.pdf$#i', '.jpg', $pageUrl);
                    $pages[] = $pageUrl;
                }
                return $pages;
            }
            return [$this->cv_preview_url];
        }

        return [$this->cv_url];
    }
}
