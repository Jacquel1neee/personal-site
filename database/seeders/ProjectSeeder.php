<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title_zh' => 'Eco Pack Hub 电商网站',
                'title_en' => 'Eco Pack Hub E-commerce',
                'category' => 'Web App',
                'description_zh' => '使用 Laravel 开发的环保包装电商网站，包含购物车、结账和后台管理功能。',
                'description_en' => 'An eco-friendly packaging e-commerce site built with Laravel, featuring cart, checkout, and admin management.',
                'github_url' => 'https://github.com/chuahjunjie/eco-pack-hub',
                'sort_order' => 1,
            ],
            [
                'title_zh' => 'Never Safe 小游戏',
                'title_en' => 'Never Safe Mini Game',
                'category' => 'Game',
                'description_zh' => '使用 Godot 引擎制作的 2D 生存类小游戏。',
                'description_en' => 'A 2D survival mini-game built with the Godot engine.',
                'github_url' => 'https://github.com/chuahjunjie/never-safe',
                'sort_order' => 2,
            ],
            [
                'title_zh' => 'UTAR 图书馆系统',
                'title_en' => 'UTAR Library System',
                'category' => 'Web App',
                'description_zh' => '基于 Laravel 的图书借阅管理系统，支持图书搜索、借阅和归还。',
                'description_en' => 'A Laravel-based library borrowing management system supporting book search, borrowing, and returning.',
                'github_url' => 'https://github.com/chuahjunjie/utar-library',
                'sort_order' => 3,
            ],
            [
                'title_zh' => '电影订票系统',
                'title_en' => 'Movie Booking System',
                'category' => 'Web App',
                'description_zh' => 'Laravel 全栈电影订票系统，支持座位选择、在线付款和票务管理。',
                'description_en' => 'A full-stack movie booking system with seat selection, online payment, and ticketing management.',
                'github_url' => 'https://github.com/chuahjunjie/movie-booking',
                'sort_order' => 4,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}