<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_zh', 'title_en',
        'category',
        'description_zh', 'description_en',
        'github_url', 'live_url',
        'image_path',
        'sort_order'
    ];

    // 分类的自动翻译
    public function getCategoryTranslatedAttribute()
    {
        $key = 'admin.cat_' . strtolower(str_replace(' ', '_', $this->category));
        return __($key) === $key ? $this->category : __($key);
    }
}