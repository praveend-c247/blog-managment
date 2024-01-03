<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Services\BlogService;
use App\Http\Requests\BlogStoreRequest;
use App\Models\{ Blogs, Categories, BlogCategories };


class BlogsController extends Controller
{
    public function __construct(private BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog_list = Blogs::where('is_deleted',0)->paginate(5);
        return view('blogs.index',compact('blog_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoriesList = Categories::where('is_deleted',0)->get();
        return view('blogs.create',compact('categoriesList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogStoreRequest $request)
    {
        $this->blogService->storeBlog($request->validated());

        if ($blog) {
            return redirect()->route('blogs.index')->with('message','Blog Create Successfully...');
        }else{
            return redirect()->route('blogs.index')->with('error','SomeThing went to be wrong...');
        }
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
        $blog = array();
        $blog = Blogs::with('blogCategories')->where('id',$id)->first();
        $categoriesList = Categories::where('is_deleted',0)->get();
        if (!empty($blog)) {
            return view('blogs.edit',compact('blog','categoriesList'));   
        }else{
            return redirect()->route('blogs.index')->with('error','This Blog is not found...');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogStoreRequest $request, Blogs $blog)
    {
        $this->blogService->updateBlog($request->validated(), $blog);

        if ($blog) {
            return redirect()->route('blogs.index')->with('message','Blog Update Successfully...');
        }else{
            return redirect()->route('blogs.index')->with('error','SomeThing went to be wrong...');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blogs::find($id);
        
        if ($blog->delete()) {
            $response = ['status'=>'true','status_code'=>200,'msg'=>'Blog Delete Successfully...'];
        }else{
            $response = ['status'=>'false','status_code'=>500,'msg'=>'SomeThing went to be wrong...'];
        }
        return json_encode($response);die();
    }

    public function blogsList(Request $request)
    {
        $blog_list = DB::table('blogs')
                    ->whereNotNull('deleted_at')
                    ->paginate(5);
        
        return view('blogs.blog-retrive-list',compact('blog_list'));
    }

    public function blogRetrive($id)
    {
        if(Blogs::where('id', $id)->withTrashed()->restore()){
            $response = ['status'=>'true','status_code'=>200,'msg'=>'Blog Retrive Successfully...'];
        }else{
            $response = ['status'=>'false','status_code'=>500,'msg'=>'SomeThing went to be wrong...'];
        }
        return json_encode($response);die();
    }
}
