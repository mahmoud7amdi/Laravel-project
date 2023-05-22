<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function AllBlog()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.blogs_all',compact('blogs'));
    }

    public function AddBlog()
    {
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        return view('admin.blogs.add_blogs',compact('categories'));
    }

    public function StoreBlog(Request $request)
    {
        $request->validate([
            'blog_category_id' => 'required',
            'blog_title' => 'required',
            'blog_image' => 'required',
            'blog_tags' => 'required',
            'blog_description' => 'required',

        ]);
        $image = $request->file('blog_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(430,327)->save('upload/blog/'.$name_gen);
        $save_url = 'upload/blog/'.$name_gen ;
        Blog::insert([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_tags' => $request->tags,
            'blog_description' => $request->blog_description,
            'blog_image' => $save_url,
            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Blog Add  successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('all.blog')->with($notification);
    }

    public function EditBlog($id)
    {
        $blogs = Blog::findOrfail($id);
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        return view('admin.blogs.edit_blogs',compact('blogs','categories'));
    }

    public function UpdateBlog(Request $request)
    {
        $blog_id = $request->id;
        if($request->file('blog_image')) {
            $image = $request->file('blog_image') ;
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(430,327)->save('upload/blog/'.$name_gen);
            $save_url = 'upload/blog/'.$name_gen;

            Blog::findOrfail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_tags' => $request->tags,
                'blog_description' => $request->blog_description,
                'blog_image' => $save_url,

            ]);
            $notification = array(
                'message' => 'Blog Updated with image  successfully',
                'alert-type' => 'success'

            );
            return redirect()->route('all.blog')->with($notification);

        }else {
            Blog::findOrfail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_tags' => $request->tags,
                'blog_description' => $request->blog_description,
            ]);
            $notification = array(
                'message' => 'Blog Updated without Image  successfully',
                'alert-type' => 'success'

            );
            return redirect()->route('all.blog')->with($notification);
        }
    }




    public function DeleteBlog($id)
    {
        $blogs = Blog::findOrfail($id);
        $image = $blogs->blog_image ;
        unlink($image);
        Blog::findOrfail($id)->delete();
        $notification = array(
            'message' => 'Blog Deleted   successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);
    }


    public function BlogDetails($id)
    {
        $allblogs = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        $blogs = Blog::findOrFail($id);
        return view('frontend.blog_details',compact('blogs','allblogs','categories'));
    }

    public function CategoryBlog($id){
        $allblogs = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        $blogpost = Blog::where('blog_category_id',$id)->orderBy('id','DESC')->get();
        $categoryname = BlogCategory::findOrFail($id);
        return view('frontend.cat_blog_details',compact('blogpost','allblogs','categories','categoryname'));
    }

    public function HomeBlog()
    {
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        $allblogs = Blog::latest()->get();
        return view('frontend.blog',compact('allblogs','categories'));
    }
}
