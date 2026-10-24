<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Criterion extends Model
{
    use HasFactory;

    protected $table = 'criteria';

    protected $fillable = [
        'code',
        'name',
        'type',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'criteria_id')->orderBy('order_num', 'asc');
    }

    public function matrixWeights(): HasMany
    {
        return $this->hasMany(MatrixWeight::class, 'criteria_id');
    }
}
