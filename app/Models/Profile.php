<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_zh', 'name_en', 
        'birthday', 
        'city_zh', 'city_en', 
        'avatar_path', 
        'slogan_zh', 'slogan_en', 
        'mbti', 
        'about_zh', 'about_en'
    ];

    protected $casts = [
        'birthday' => 'date',
    ];

    // 自动计算年龄的访问器 (前台直接调用 $profile->age)
    public function getAgeAttribute(): int
    {
        if (!$this->birthday) {
            return 0;
        }
        return $this->birthday->age;
    }
}