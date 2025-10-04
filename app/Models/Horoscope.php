<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horoscope extends Model
{
    use HasFactory;

    protected $fillable = [
        'sign',
        'content',
        'date',
        'is_active',
        'scheduled_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'date' => 'date',
        'scheduled_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeScheduled($query)
    {
        return $query->whereNotNull('scheduled_at');
    }

    public function scopeBySign($query, $sign)
    {
        return $query->where('sign', $sign);
    }

    public function scopeByDate($query, $date)
    {
        return $query->where('date', $date);
    }

    public static function getSigns()
    {
        return [
            'aries' => 'Aries',
            'taurus' => 'Taurus',
            'gemini' => 'Gemini',
            'cancer' => 'Cancer',
            'leo' => 'Leo',
            'virgo' => 'Virgo',
            'libra' => 'Libra',
            'scorpio' => 'Scorpio',
            'sagittarius' => 'Sagittarius',
            'capricorn' => 'Capricorn',
            'aquarius' => 'Aquarius',
            'pisces' => 'Pisces',
        ];
    }
}
