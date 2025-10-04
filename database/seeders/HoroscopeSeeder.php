<?php

namespace Database\Seeders;

use App\Models\Horoscope;
use Illuminate\Database\Seeder;

class HoroscopeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $signs = Horoscope::getSigns();
        $today = now()->format('Y-m-d');

        foreach ($signs as $signKey => $signName) {
            Horoscope::create([
                'sign' => $signKey,
                'content' => "Today brings new opportunities for {$signName}. Trust your instincts and embrace the changes coming your way. Your natural charisma will help you navigate any challenges.",
                'date' => $today,
                'is_active' => true,
            ]);
        }
    }
}
