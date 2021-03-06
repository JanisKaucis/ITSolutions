<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DelfiRss extends Model
{
    use HasFactory;
    protected $fillable = [
        'news_id',
        'title',
        'link',
        'description',
        'image',
        'date'
    ];
}
