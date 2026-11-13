<?php

namespace Database\Seeders;

use App\Models\Hobby;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    public function run(): void
    {
        $hobbies = [
            [
                'name_zh' => '传统跆拳道',
                'name_en' => 'Traditional Taekwondo',
                'icon' => '🥋',
                'description_zh' => ' practising Taekwondo for years, keeping both mind and body sharp.',
                'description_en' => 'Practicing Taekwondo for years, keeping both mind and body sharp.',
                'sort_order' => 1,
            ],
            [
                'name_zh' => '格斗运动',
                'name_en' => 'Combat Sports',
                'icon' => '🥊',
                'description_zh' => '喜欢各种格斗技，偶尔接一些兼职教练工作。',
                'description_en' => 'Enjoy various combat sports, occasionally taking part-time coaching jobs.',
                'sort_order' => 2,
            ],
            [
                'name_zh' => '睡觉',
                'name_en' => 'Sleeping',
                'icon' => '😴',
                'description_zh' => '最好的充电方式。',
                'description_en' => 'The best way to recharge.',
                'sort_order' => 3,
            ],
        ];

        foreach ($hobbies as $hobby) {
            Hobby::create($hobby);
        }
    }
}