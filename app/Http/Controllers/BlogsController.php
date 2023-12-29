<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\Categories;
use App\Models\BlogCategories;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog_list = Blogs::where('is_deleted',0)->get();
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'blog_media' => 'required',
            'date' => 'required',
            'time' => 'required',
            'tags' => 'required',
            'categories' => 'required'
        ]);
        $blog = new Blogs();
        $blog->title = $request->title;
        $blog->short_description = $request->short_description;
        $blog->description = $request->description;
        $fileArray = [];
        if(isset($request->blog_media)){
            foreach ($request->blog_media as $key => $value) {
                $destinationPath = 'uploads/blog_media';
                $file = $value->getClientOriginalName();
                $name = explode('.',$file);
                $file_name = $name[0].time();
                $extension = $value->getClientOriginalExtension();
                $fileName = $file_name.'.'.$extension;
                $value->move($destinationPath,$fileName);
                $fileArray[] = $destinationPath.'/'.$fileName;
            }
        }
        $blog->blog_media = json_encode($fileArray);
        $blog->date = $request->date;
        $blog->time = $request->time;
        $blog->tags = $request->tags;
        if ($blog->save()) {
            foreach ($request->categories as $cat_key => $cat_value) {
                $blogCategories = new BlogCategories();
                $blogCategories->blogs_id = $blog->id;
                $blogCategories->categories_id = $cat_value;
                $blogCategories->save();
                
            }
            return redirect()->route('blogs.index')->with('success','Blog Create Successfully...');
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
        $blog = Blogs::with('BlogCategories')->where('id',$id)->first();
        $categoriesList = Categories::where('is_deleted',0)->get();
        return view('blogs.edit',compact('blog','categoriesList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' => 'required',
            'tags' => 'required',
            'categories' => 'required'
        ]);
        $blog = Blogs::find($id);
        $blog->title = $request->title;
        $blog->short_description = $request->short_description;
        $blog->description = $request->description;
        $fileArray = [];
        if(isset($request->blog_media)){
            
            foreach ($request->blog_media as $key => $value) {
                $destinationPath = 'uploads/blog_media';
                $file = $value->getClientOriginalName();
                $name = explode('.',$file);
                $file_name = $name[0].time();
                $extension = $value->getClientOriginalExtension();
                $fileName = $file_name.'.'.$extension;
                $value->move($destinationPath,$fileName);
                $fileArray1[] = $destinationPath.'/'.$fileName;
            }
            $oldArray = json_decode($request->old_media);
            $fileArray = array_merge($oldArray, $fileArray1);
        }else{
            $fileArray = json_decode($request->old_media);
        }
        
        $blog->blog_media = json_encode($fileArray);
        $blog->date = $request->date;
        $blog->time = $request->time;
        $blog->tags = $request->tags;
        
        if ($blog->update()) {
            $deleteCategories = BlogCategories::where('blogs_id',$blog->id)->delete();
            foreach ($request->categories as $cat_key => $cat_value) {
                $blogCategories = new BlogCategories();
                $blogCategories->blogs_id = $blog->id;
                $blogCategories->categories_id = $cat_value;
                $blogCategories->save();
                
            }
            $notification = array(
                'message' => 'Blog Update Successfully...',
                'alert-type' => 'success'
            );
            return redirect()->route('blogs.index')->with($notification);
        }else{
            $notification = array(
                'message' => 'SomeThing went to be wrong...',
                'alert-type' => 'error'
            );
            return redirect()->route('blogs.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blogs::find($id);
        $blog->is_deleted = 1;
        if ($blog->update()) {
            $notification = array(
                'message' => 'Blog Deleted Successfully...',
                'alert-type' => 'success'
            );
            return redirect()->route('blogs.index')->with($notification);
        }else{
            $notification = array(
                'message' => 'SomeThing went to be wrong...',
                'alert-type' => 'error'
            );
            return redirect()->route('blogs.index')->with($notification);
        }
    }
}
