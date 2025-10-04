<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MotivationalQuote;
use App\Models\Horoscope;
use Illuminate\Support\Facades\Log;

class UpdateContent extends Command
{
    protected $signature = 'content:update';
    protected $description = 'Update motivational quotes and horoscopes content';

    public function handle()
    {
        // Example: Log update, or implement logic to fetch/update content
        Log::info('Content update triggered.');
        // You can add logic to update content here
        $this->info('Content updated successfully.');
    }
}
