<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    public $table = 'members';


    public function blogs()
    {   
        return $this->hasOne(Blog::class,'user_id',);
    }
}
