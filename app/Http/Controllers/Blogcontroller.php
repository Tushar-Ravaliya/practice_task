<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blog_imagel;
use App\Models\Blog;
use App\Models\Blog_image;
use App\Models\Link;
use Illuminate\Support\Facades\DB;

class Blogcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Category::select()->get();
        return view('addblogs', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:blogs,title',
            'description' => 'required|min:50',
        ]);

        // $blog = Blog::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'user_id' => session('user_id'),
        //     'category' => json_encode($request->categories)
        // ]);

        $blog->images()->create([
            
        ])

        $blogs_table = new Blog;
        $blog_images_table = new Blog_image;
        $blogs_table->title = $request->title;
        $blogs_table->description = $request->description;
        $blogs_table->user_id = session('user_id');
        $blogs_table->category = json_encode($request->categories);
        $images_and_links_id = session('user_id') . uniqid();
        $blogs_table->images_and_links_id = $images_and_links_id;


        $image_array = [];
        if (!empty($request->file('blog_images'))) {
            foreach ($request->file('blog_images') as $image) {

                $image_name = uniqid() . $image->getClientOriginalName();
                $image->move('blogs_images', $image_name);
                $image_array[] = $image_name;
            }
            $blog_images_table->images = json_encode($image_array);
            $blog_images_table->images_and_links_id = $images_and_links_id;
            $blog_images_table->save();
        }
        $i = 0;
        if (isset($request->blog_title) && isset($request->blog_link)) {
            foreach ($request->blog_title as $title) {
                $links_table = new link;

                // DB::table('links')->insert(['title' => $title, 'links' => $request->blog_link[$i], 'image_and_links_id' => $images_and_links_id]);
                $links_table->title = $title;
                $links_table->links = $request->blog_link[$i];
                $links_table->images_and_links_id = $images_and_links_id;
                $i = $i + 1;
                $links_table->save();
            }
        }
        $blogs_table->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
