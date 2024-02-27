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
        $blogs = Blog::with('images')->get();

        // dd($blogs);

        $Blog = Blog::select()->get();
        // return dd($results);
        return view('home', compact('Blog'));
    }
}
