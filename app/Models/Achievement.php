<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_zh', 'title_en',
        'issuer_zh', 'issuer_en',
        'year',
        'sort_order'
    ];
}