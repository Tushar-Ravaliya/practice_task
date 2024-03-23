<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Blog_image;
use App\Models\Link;
use Illuminate\Support\Facades\File;
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

        $blog = Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => json_encode($request->categories),
            'user_id' => session('user_id'),
        ]);

        if (!empty($request->file('blog_images'))) {
            foreach ($request->file('blog_images') as $image) {

                $image_name = uniqid() . $image->getClientOriginalName();
                $image->move('blogs_images', $image_name);
                $blog->images()->create([
                    'images' => $image_name,
                ]);
            }
        }
        if (isset($request->blog_title) && isset($request->blog_link)) {
           
            $titles = $request->blog_title;
            $links = $request->blog_link;
            for ($i = 0; $i < count($titles); $i++) {
                $blog->links()->create([
                    'link_title' => $titles[$i],
                    'links' => $links[$i],
                ]);
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blogs = Blog::with('images')->with('links')->where('user_id',$id)->latest()->paginate(5);
        return view('myblogs', compact('blogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blogs = Blog::with('images')->with('links')->where('id',$id)->first();
        $data = Category::select()->get();
        return view('editblog', compact('blogs','data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|min:50',
        ]);
        $blog = Blog::with('images')->with('links')->where('id',$id)->first();

            $blog->where('id', $id)->update(array('title' => $request->title, 'description' => $request->description, 'category' => json_encode($request->categories)));

        if (!empty($request->file('blog_images'))) {
            $blog->images()->where('blog_id',$blog['id'])->delete(); 
            foreach ($blog->images() as $blog_image) {
                $file_name = "blogs_images/" . $blog_image['images'];
                if (File::exists($file_name)) {
                    File::delete($file_name);
                }
            }
            foreach ($request->file('blog_images') as $image) {
               
                $image_name = uniqid() . $image->getClientOriginalName();
                $image->move('blogs_images', $image_name);
                $blog->images()->create([
                    'images' => $image_name,
                ]);
            }
        }
        if (isset($request->blog_title) && isset($request->blog_link)) {
           
            $titles = $request->blog_title;
            $links = $request->blog_link;

            if (!empty($titles) && !empty($links)) {
                $blog->links()->where('blog_id',$blog['id'])->delete(); 
            }
            for ($i = 0; $i < count($titles); $i++) {
                $blog->links()->create([
                    'link_title' => $titles[$i],
                    'links' => $links[$i],
                ]);
            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Blog::where('id',$id)->delete();
        return redirect()->back();
    }
}
