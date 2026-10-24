<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatrixWeight extends Model
{
    use HasFactory;

    protected $fillable = [
        'division_id',
        'criteria_id',
        'weight_percentage',
    ];

    protected $casts = [
        'weight_percentage' => 'float',
    ];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function criterion(): BelongsTo
    {
        return $this->belongsTo(Criterion::class, 'criteria_id');
    }
}
