<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'level',
        'icon',
        'description',
        'order',
        'is_active'
    ];

    protected $casts = [
        'level' => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeByCategory(Builder $query, string $category): void
    {
        $query->where('category', $category);
    }

    public function scopeOrdered(Builder $query): void
    {
        $query->orderBy('order')->orderBy('name');
    }

    public function getLevelPercentageAttribute(): int
    {
        return ($this->level / 5) * 100;
    }

    public function getLevelTextAttribute(): string
    {
        return match($this->level) {
            1 => 'Básico',
            2 => 'Intermedio Bajo',
            3 => 'Intermedio',
            4 => 'Intermedio Alto',
            5 => 'Avanzado',
            default => 'Básico'
        };
    }
}
