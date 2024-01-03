<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\Models\{Blogs, BlogCategories};

/**
 * Class BlogService.
 */
class BlogService
{
    public static function storeBlog(array $blogData): Blogs
    {
        foreach ($blogData['categories'] as $key => $value) {
            $newArray = ['categories_id' => $value];
        }
        $fileArray = [];
        if(isset($blogData['blog_media'])){
            
            foreach ($blogData['blog_media'] as $key => $value) {
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
        $blogData['blog_media'] = json_encode($fileArray);

        $blog = Blogs::create($blogData);
        foreach ($blogData['categories'] as $cat_key => $cat_value) {
            $blogCategories = new BlogCategories();
            $blogCategories->blogs_id = $blog->id;
            $blogCategories->categories_id = $cat_value;
            $blogCategories->save();
            
        }
        // $categoriesData = $newArray;
        // $blog->blogCategories()->create($categoriesData);

        return $blog;
    }

    public static function updateBlog(array $blogData, Blogs $blog): Blogs
    {
        if(isset($blogData['blog_media'])){
            foreach ($blogData['blog_media'] as $key => $value) {
                $destinationPath = 'uploads/blog_media';
                $file = $value->getClientOriginalName();
                $name = explode('.',$file);
                $file_name = $name[0].time();
                $extension = $value->getClientOriginalExtension();
                $fileName = $file_name.'.'.$extension;
                $value->move($destinationPath,$fileName);
                $fileArray[] = $destinationPath.'/'.$fileName;
            }
            $blogData['blog_media'] = json_encode($fileArray);
        }
        $blog->update($blogData);
        $deleteCategories = BlogCategories::where('blogs_id',$blog->id)->delete();
        foreach ($blogData['categories'] as $cat_key => $cat_value) {
            $blogCategories = new BlogCategories();
            $blogCategories->blogs_id = $blog->id;
            $blogCategories->categories_id = $cat_value;
            $blogCategories->save();
            
        }
        return $blog;
    }
}
