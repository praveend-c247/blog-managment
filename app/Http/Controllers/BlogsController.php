<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Services\BlogService;
use App\Http\Requests\BlogStoreRequest;
use App\Models\{ Blogs, Categories, BlogCategories };


class BlogsController extends Controller
{
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
        (new BlogService())->storeBlog($request->validated());
        // $blog = new Blogs();
        // $blog->title = $request->title;
        // $blog->short_description = $request->short_description;
        // $blog->description = $request->description;
        // $fileArray = [];
        // if(isset($request->blog_media)){
        //     foreach ($request->blog_media as $key => $value) {
        //         $destinationPath = 'uploads/blog_media';
        //         $file = $value->getClientOriginalName();
        //         $name = explode('.',$file);
        //         $file_name = $name[0].time();
        //         $extension = $value->getClientOriginalExtension();
        //         $fileName = $file_name.'.'.$extension;
        //         $value->move($destinationPath,$fileName);
        //         $fileArray[] = $destinationPath.'/'.$fileName;
        //     }
        // }
        // $blog->blog_media = json_encode($fileArray);
        // $blog->date = $request->date;
        // $blog->time = $request->time;
        // $blog->tags = $request->tags;
        // if ($blog->save()) {
        //     foreach ($request->categories as $cat_key => $cat_value) {
        //         $blogCategories = new BlogCategories();
        //         $blogCategories->blogs_id = $blog->id;
        //         $blogCategories->categories_id = $cat_value;
        //         $blogCategories->save();
                
        //     }
        //     return redirect()->route('blogs.index')->with('message','Blog Create Successfully...');
        // }else{
        //     return redirect()->route('blogs.index')->with('error','SomeThing went to be wrong...');
        // }
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
        return view('blogs.edit',compact('blog','categoriesList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogStoreRequest $request, string $id)
    {
        (new BlogService())->storeBlog($request->validated(), $id);

        if ($blog) {
            $notification = array(
                'message' => 'Blog Update Successfully...',
                'alert-type' => 'success'
            );
            return redirect()->route('blogs.index')->with('message','Blog Update Successfully...');
        }else{
            $notification = array(
                'message' => 'SomeThing went to be wrong...',
                'alert-type' => 'error'
            );
            return redirect()->route('blogs.index')->with('error','SomeThing went to be wrong...');
        }
        // $blog = Blogs::find($id);
        // $blog->title = $request->title;
        // $blog->short_description = $request->short_description;
        // $blog->description = $request->description;
        // $fileArray = [];
        // if(isset($request->blog_media)){
            
        //     foreach ($request->blog_media as $key => $value) {
        //         $destinationPath = 'uploads/blog_media';
        //         $file = $value->getClientOriginalName();
        //         $name = explode('.',$file);
        //         $file_name = $name[0].time();
        //         $extension = $value->getClientOriginalExtension();
        //         $fileName = $file_name.'.'.$extension;
        //         $value->move($destinationPath,$fileName);
        //         $fileArray1[] = $destinationPath.'/'.$fileName;
        //     }
        //     $oldArray = json_decode($request->old_media);
        //     $fileArray = array_merge($oldArray, $fileArray1);
        // }else{
        //     $fileArray = json_decode($request->old_media);
        // }
        
        // $blog->blog_media = json_encode($fileArray);
        // $blog->date = $request->date;
        // $blog->time = $request->time;
        // $blog->tags = $request->tags;
        
        // if ($blog->update()) {
        //     $deleteCategories = BlogCategories::where('blogs_id',$blog->id)->delete();
        //     foreach ($request->categories as $cat_key => $cat_value) {
        //         $blogCategories = new BlogCategories();
        //         $blogCategories->blogs_id = $blog->id;
        //         $blogCategories->categories_id = $cat_value;
        //         $blogCategories->save();
                
        //     }
        //     $notification = array(
        //         'message' => 'Blog Update Successfully...',
        //         'alert-type' => 'success'
        //     );
        //     return redirect()->route('blogs.index')->with('message','Blog Update Successfully...');
        // }else{
        //     $notification = array(
        //         'message' => 'SomeThing went to be wrong...',
        //         'alert-type' => 'error'
        //     );
        //     return redirect()->route('blogs.index')->with('error','SomeThing went to be wrong...');
        // }
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
