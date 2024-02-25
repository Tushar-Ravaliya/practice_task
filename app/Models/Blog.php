<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    public $table = 'blogs';

    public function images() {
        return $this->hasMany(Blog_image::class, 'images_and_links_id', 'images_and_links_id');
    }
}
