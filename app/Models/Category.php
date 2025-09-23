<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'icon',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): void
    {
        $query->orderBy('order')->orderBy('name');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Obtener el emoji del icono
     */
    public function getIconEmojiAttribute(): string
    {
        return \App\Helpers\IconHelper::getIconEmojiOnly($this->icon);
    }

    /**
     * Obtener el nombre del icono
     */
    public function getIconNameAttribute(): string
    {
        return \App\Helpers\IconHelper::getIconNameOnly($this->icon);
    }
}
