<?php

namespace Database\Seeders;

use App\Models\VoiceOption;
use Illuminate\Database\Seeder;

class VoiceOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $voiceOptions = [
            [
                'name' => 'Female Voice - English (US)',
                'voice_id' => 'en-US-Wavenet-A',
                'language' => 'en-US',
                'gender' => 'female',
                'speed' => 3,
                'pitch' => 3,
                'is_active' => true,
                'description' => 'Natural sounding female voice for English (US)',
            ],
            [
                'name' => 'Male Voice - English (US)',
                'voice_id' => 'en-US-Wavenet-D',
                'language' => 'en-US',
                'gender' => 'male',
                'speed' => 3,
                'pitch' => 3,
                'is_active' => true,
                'description' => 'Natural sounding male voice for English (US)',
            ],
            [
                'name' => 'Female Voice - English (UK)',
                'voice_id' => 'en-GB-Wavenet-A',
                'language' => 'en-GB',
                'gender' => 'female',
                'speed' => 3,
                'pitch' => 3,
                'is_active' => true,
                'description' => 'British female voice for English (UK)',
            ],
            [
                'name' => 'Male Voice - Spanish',
                'voice_id' => 'es-ES-Wavenet-B',
                'language' => 'es-ES',
                'gender' => 'male',
                'speed' => 3,
                'pitch' => 3,
                'is_active' => true,
                'description' => 'Spanish male voice for Spain',
            ],
            [
                'name' => 'Female Voice - French',
                'voice_id' => 'fr-FR-Wavenet-A',
                'language' => 'fr-FR',
                'gender' => 'female',
                'speed' => 3,
                'pitch' => 3,
                'is_active' => true,
                'description' => 'French female voice for France',
            ],
        ];

        foreach ($voiceOptions as $voiceOption) {
            VoiceOption::create($voiceOption);
        }
    }
}
