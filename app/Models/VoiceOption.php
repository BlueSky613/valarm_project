<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoiceOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'voice_id',
        'language',
        'gender',
        'speed',
        'pitch',
        'is_active',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'speed' => 'integer',
        'pitch' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByLanguage($query, $language)
    {
        return $query->where('language', $language);
    }

    public function scopeByGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }
}
