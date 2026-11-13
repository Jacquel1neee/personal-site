<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::create([
            'name_zh' => '蔡俊杰',
            'name_en' => 'Chuah Jun Jie',
            'birthday' => '2003-10-15',
            'city_zh' => '吉隆坡，马来西亚',
            'city_en' => 'Kuala Lumpur, Malaysia',
            'slogan_zh' => '保持善良',
            'slogan_en' => 'Stay Kind',
            'mbti' => 'INFP-T',
            'about_zh' => '我是一个很随性的人，可以看开所有问题，但同时有很强的责任感。目前是一名全栈开发者，也是个兼职跆拳道教练。',
            'about_en' => 'I am a free-spirited person who can let go of problems, but I have a strong sense of responsibility. Currently a full-stack developer and a part-time Taekwondo coach.',
        ]);
    }
}