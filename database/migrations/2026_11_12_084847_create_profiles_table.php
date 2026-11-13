<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            
            // 基本信息
            $table->string('name_zh');
            $table->string('name_en');
            $table->date('birthday'); // 用于自动算年龄
            $table->string('city_zh');
            $table->string('city_en');
            
            // 头像
            $table->string('avatar_path')->nullable(); // 存相对路径
            
            // 标语和性格
            $table->string('slogan_zh')->nullable();
            $table->string('slogan_en')->nullable();
            $table->string('mbti')->nullable(); // 如 INFP-T
            $table->text('about_zh')->nullable(); // 长的自我介绍
            $table->text('about_en')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};