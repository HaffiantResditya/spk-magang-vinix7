<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function matrixWeights(): HasMany
    {
        return $this->hasMany(MatrixWeight::class);
    }

    public function sawResults(): HasMany
    {
        return $this->hasMany(SawResult::class);
    }

    public function applicationsSelected(): HasMany
    {
        return $this->hasMany(Application::class, 'selected_division_id');
    }

    public function applicationsApproved(): HasMany
    {
        return $this->hasMany(Application::class, 'approved_division_id');
    }
}
