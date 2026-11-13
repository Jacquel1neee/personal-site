<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $experiences = [
            [
                'company_zh' => 'Zen X Tech Sdn. Bhd.',
                'company_en' => 'Zen X Tech Sdn. Bhd.',
                'role_zh' => '初级 PHP Web 开发',
                'role_en' => 'Junior PHP Web Developer',
                'start_date' => '2026-11-01',
                'end_date' => null,
                'description_zh' => '负责开发和维护公司内部的电商后台系统，主要使用 Laravel 框架。',
                'description_en' => 'Responsible for developing and maintaining internal e-commerce backend systems, mainly using the Laravel framework.',
                'sort_order' => 1,
            ],
            [
                'company_zh' => 'One Martial Art',
                'company_en' => 'One Martial Art',
                'role_zh' => '跆拳道教练（兼职）',
                'role_en' => 'Taekwondo Coach (Part-time)',
                'start_date' => '2025-07-01',
                'end_date' => null,
                'description_zh' => '教授传统跆拳道，帮助学员提升体能和技巧。',
                'description_en' => 'Teaching traditional Taekwondo, helping students improve their physical fitness and skills.',
                'sort_order' => 2,
            ],
            [
                'company_zh' => 'Weitizen Sdn Bhd',
                'company_en' => 'Weitizen Sdn Bhd',
                'role_zh' => '软件工程实习生',
                'role_en' => 'Software Engineering Intern',
                'start_date' => '2025-10-01',
                'end_date' => '2026-01-31',
                'description_zh' => '使用 Laravel + Vue 制作各个电商平台后台的页面模块。',
                'description_en' => 'Used Laravel + Vue to build page modules for e-commerce platform backends.',
                'sort_order' => 3,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::create($exp);
        }
    }
}