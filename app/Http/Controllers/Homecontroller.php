<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Blog_image;
use App\Models\Link;
use Illuminate\Support\Facades\DB;

class Homecontroller extends Controller
{
    public function show_blogs()
    {
        $blogs = Blog::with('images')->with('links')->get();
        return view('home', compact('blogs'));
    }
    public function url($link)
    {
        $url = 'http://'.$link;
        return redirect($url);
        
    }

}
