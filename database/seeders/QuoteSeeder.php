<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quotes = [
            [
                'content' => 'Success is not final, failure is not fatal: it is the courage to continue that counts.',
                'author' => 'Winston Churchill',
                'category' => 'success',
                'is_active' => true,
            ],
            [
                'content' => 'The only way to do great work is to love what you do.',
                'author' => 'Steve Jobs',
                'category' => 'work',
                'is_active' => true,
            ],
            [
                'content' => 'Life is what happens to you while you\'re busy making other plans.',
                'author' => 'John Lennon',
                'category' => 'life',
                'is_active' => true,
            ],
            [
                'content' => 'The future belongs to those who believe in the beauty of their dreams.',
                'author' => 'Eleanor Roosevelt',
                'category' => 'dreams',
                'is_active' => true,
            ],
            [
                'content' => 'It is during our darkest moments that we must focus to see the light.',
                'author' => 'Aristotle',
                'category' => 'motivation',
                'is_active' => true,
            ],
            [
                'content' => 'The way to get started is to quit talking and begin doing.',
                'author' => 'Walt Disney',
                'category' => 'action',
                'is_active' => true,
            ],
            [
                'content' => 'Don\'t be afraid to give up the good to go for the great.',
                'author' => 'John D. Rockefeller',
                'category' => 'success',
                'is_active' => true,
            ],
            [
                'content' => 'Innovation distinguishes between a leader and a follower.',
                'author' => 'Steve Jobs',
                'category' => 'innovation',
                'is_active' => true,
            ],
        ];

        foreach ($quotes as $quote) {
            Quote::create($quote);
        }
    }
}
