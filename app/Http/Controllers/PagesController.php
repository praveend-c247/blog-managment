<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\Reaction;

class PagesController extends Controller
{
    private $emojis = ['👍', '❤️', '😂', '😲', '😢', '😡'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function HomePage(Request $request)
    {
        $blogList = Blogs::with('BlogCategories')->where('is_deleted',0)->get();
        // $blogs = Blogs::leftJoin('blog_categories','blog_categories.blogs_id','=','blogs.id')
        //                 ->where('blogs.is_deleted',0)
        //                 ->select('blogs.*','blog_categories.categories_id')
        //                 ->get();
        return view('pages.homepage',compact('blogList'));
    }

    public function BlogDetailPage(Request $request)
    {
        $blogDetail = Blogs::with('BlogCategories','comments')->where('is_deleted',0)->where('id',$request->id)->first();
        $emojis = $this->emojis;

        $reactionCounts = Reaction::where('reactable_id', $request->id)
                            ->select('type','emoji', \DB::raw('count(*) as count'))
                            ->groupBy('type','emoji')
                            ->get();
        return view('pages.blog-detail',compact('blogDetail','emojis','reactionCounts'));
    }

    public function BlogsPage(Request $request)
    {
        $blogList = Blogs::with('BlogCategories','comments')->where('is_deleted',0)->get();
        return view('pages.blog',compact('blogList'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $postId)
    {
        $post = Blogs::with('comments')->find($postId); // Assuming you have a Post model

        return view('pages.show', ['post' => $post]);
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
