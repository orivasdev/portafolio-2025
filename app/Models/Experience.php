<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'description',
        'start_date',
        'end_date',
        'is_current',
        'location',
        'type',
        'technologies_used',
        'order',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'technologies_used' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): void
    {
        $query->orderBy('order')->orderBy('start_date', 'desc');
    }

    public function scopeCurrent(Builder $query): void
    {
        $query->where('is_current', true);
    }

    public function getDurationAttribute(): string
    {
        $start = Carbon::parse($this->start_date);
        
        if ($this->is_current) {
            $end = Carbon::now();
        } else {
            $end = Carbon::parse($this->end_date);
        }

        $years = $start->diffInYears($end);
        $months = $start->diffInMonths($end) % 12;

        if ($years > 0 && $months > 0) {
            return "{$years} año" . ($years > 1 ? 's' : '') . " {$months} mes" . ($months > 1 ? 'es' : '');
        } elseif ($years > 0) {
            return "{$years} año" . ($years > 1 ? 's' : '');
        } else {
            return "{$months} mes" . ($months > 1 ? 'es' : '');
        }
    }

    public function getFormattedStartDateAttribute(): string
    {
        return $this->start_date->format('M Y');
    }

    public function getFormattedEndDateAttribute(): string
    {
        if ($this->is_current) {
            return 'Presente';
        }
        return $this->end_date->format('M Y');
    }
}
