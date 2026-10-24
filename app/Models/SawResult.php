<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SawResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'division_id',
        'final_score',
        'rank',
    ];

    protected $casts = [
        'final_score' => 'float',
        'rank' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }
}
