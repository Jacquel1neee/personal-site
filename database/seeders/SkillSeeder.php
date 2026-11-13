<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            // Backend
            ['name' => 'Laravel', 'category' => 'Backend', 'sort_order' => 1],
            ['name' => 'PHP', 'category' => 'Backend', 'sort_order' => 2],
            ['name' => 'Python', 'category' => 'Backend', 'sort_order' => 3],
            ['name' => 'Java', 'category' => 'Backend', 'sort_order' => 4],
            // Frontend
            ['name' => 'Vue.js', 'category' => 'Frontend', 'sort_order' => 1],
            ['name' => 'HTML', 'category' => 'Frontend', 'sort_order' => 2],
            ['name' => 'CSS', 'category' => 'Frontend', 'sort_order' => 3],
            ['name' => 'JavaScript / TypeScript', 'category' => 'Frontend', 'sort_order' => 4],
            // Tools & Others
            ['name' => 'MySQL / SQL', 'category' => 'Database', 'sort_order' => 1],
            ['name' => 'C++', 'category' => 'Language', 'sort_order' => 1],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}