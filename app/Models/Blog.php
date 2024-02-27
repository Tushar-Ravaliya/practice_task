<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'category',
        'user_id',
    ];

    public function images() {
        return $this->hasMany(Blog_image::class);
    }

    public function links() {
        return $this->hasMany(Link::class);
    }
}
