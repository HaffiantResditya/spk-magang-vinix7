<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'selected_division_id',
        'approved_division_id',
        'status',
        'hrd_notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function selectedDivision(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'selected_division_id');
    }

    public function approvedDivision(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'approved_division_id');
    }
}
