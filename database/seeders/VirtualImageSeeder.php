<?php

namespace Database\Seeders;

use App\Models\VirtualImage;
use Illuminate\Database\Seeder;

class VirtualImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $virtualImages = [
            [
                'name' => 'Default Avatar',
                'image_path' => 'virtual-images/default-avatar.png',
                'category' => 'avatar',
                'description' => 'Default avatar image for virtual assistant',
                'is_active' => true,
            ],
            [
                'name' => 'Background Pattern 1',
                'image_path' => 'virtual-images/background-1.jpg',
                'category' => 'background',
                'description' => 'Abstract background pattern for presentations',
                'is_active' => true,
            ],
            [
                'name' => 'Icon Set A',
                'image_path' => 'virtual-images/icons-a.png',
                'category' => 'icon',
                'description' => 'Collection of UI icons for interface design',
                'is_active' => true,
            ],
        ];

        foreach ($virtualImages as $virtualImage) {
            VirtualImage::create($virtualImage);
        }
    }
}
