<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'short_description',
        'image',
        'github_url',
        'live_url',
        'technologies',
        'category_id',
        'order',
        'is_featured',
        'is_active'
    ];

    protected $casts = [
        'technologies' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    public function scopeByCategory(Builder $query, string $category): void
    {
        $query->whereHas('category', function ($q) use ($category) {
            $q->where('slug', $category);
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image && !str_starts_with($this->image, 'http')) {
            return asset('storage/' . $this->image);
        }
        return $this->image ?? asset('images/default-project.jpg');
    }

    public function getTechnologiesListAttribute(): array
    {
        return $this->technologies ?? [];
    }

    public function getCategoryNameAttribute(): string
    {
        return $this->category ? $this->category->name : 'Sin categoría';
    }
}
