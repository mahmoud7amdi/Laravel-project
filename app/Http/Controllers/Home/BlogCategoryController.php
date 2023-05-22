<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function AllBlogCategory()
    {
        $blogcategory = BlogCategory::latest()->get();
        return view('admin.blog_category.blog_category_all',compact('blogcategory'));
    }

    public function AddBlogCategory()
    {
        return view('admin.blog_category.add_blog_category');
    }

    public function StoreBlogCategory(Request $request)
    {
        $request->validate([
            'blog_category' => 'required'
        ]);

        BlogCategory::insert([
            'blog_category' => $request->blog_category
        ]);
        $notification = array(
            'message' => 'Blog Category Added  successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('all.blog.category')->with($notification);

    }

    public function EditBlogCategory($id)
    {
        $blogcategory = BlogCategory::findOrFail($id);
        return view('admin.blog_category.edit_blog_category',compact('blogcategory'));
    }

    public function UpdateBlogCategory(Request $request ,$id)
    {
        BlogCategory::findOrFail($id)->update([
            'blog_category' => $request->blog_category
        ]);
        $notification = array(
            'message' => 'Blog Category Updated  successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('all.blog.category')->with($notification);
    }


    public function DeleteBlogCategory($id)
    {
        BlogCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Blog Category Deleted  successfully',
            'alert-type' => 'success'

        );
        return redirect()->route('all.blog.category')->with($notification);
    }
}
