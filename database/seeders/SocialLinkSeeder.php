<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            [
                'platform' => 'GitHub',
                'url' => 'https://github.com/chuahjunjie', // 你之后可以在后台改
                'icon' => '🐙',
                'sort_order' => 1,
            ],
            [
                'platform' => 'LinkedIn',
                'url' => 'https://linkedin.com/in/chuahjunjie',
                'icon' => '💼',
                'sort_order' => 2,
            ],
            [
                'platform' => 'Email',
                'url' => 'mailto:chuahjunjie520@gmail.com',
                'icon' => '✉️',
                'sort_order' => 3,
            ],
        ];

        foreach ($links as $link) {
            SocialLink::create($link);
        }
    }
}