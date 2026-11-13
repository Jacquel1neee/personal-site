<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_zh', 'name_en',
        'icon',
        'description_zh', 'description_en',
        'sort_order'
    ];
}