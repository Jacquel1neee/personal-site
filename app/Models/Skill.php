<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'category', 
        'sort_order'
    ];

    // 返回翻译后的分类名
    public function getCategoryTranslatedAttribute()
    {
        // 把 "Frontend" 变成 "cat_frontend"，然后尝试翻译
        $key = 'admin.cat_' . strtolower($this->category);
        
        // 如果是自定义分类（比如 Networking），没有翻译键，就显示原值
        return __($key) === $key ? $this->category : __($key);
    }
}