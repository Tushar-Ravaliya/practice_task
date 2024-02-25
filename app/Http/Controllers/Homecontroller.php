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

        dd($blogs);

        $Blog = Blog::select()->get();
        $Blog_image = Blog_image::select()->get();
        $Link = Link::select()->get();
        $data = $Blog . $Blog_image . $Link;
        // $results = DB::select('SELECT * FROM blogs INNER JOIN blog_images ON blogs.images_and_links_id = blog_images.images_and_links_id INNER JOIN links ON blog_images.images_and_links_id = links.images_and_links_id');
        $results = DB::table('blogs')
            ->join('blog_images', 'blog_images.images_and_links_id', '=', 'blogs.images_and_links_id')
            ->join('links', 'links.images_and_links_id', '=', 'blog_images.images_and_links_id')
            // ->where('links.images_and_links_id', '=', 'blogs.images_and_links_id')
            ->get();
        // return dd($results);
        return view('home', compact('Blog'));
    }
}
