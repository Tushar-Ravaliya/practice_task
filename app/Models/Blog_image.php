<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog_image extends Model
{
    use HasFactory;
    protected $fillable = [
        'images',
    ];
}
