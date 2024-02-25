<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog_image extends Model
{
    use HasFactory;
    public $table = 'blog_images';
    protected $fillable = [
        'image_and_links_id',
        'images',
    ];
}
