<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Validation\Rule;

class AdminBlogController extends Controller
{
    public function index()
    {
        return view('bensai.blogs.index',[
            'blogs'=>Blog::latest()->paginate(6)
        ]);
    }

    public function create()
    {
        return view('bensai.blogs.create',[
            'categories'=>Category::all()
        ]);
    }

    public function store()
    {
        $formData=request()->validate([
            'title'=>['required'],
            'slug'=>['required',Rule::unique('blogs','slug')],
            'intro'=>['required'],
            'body'=>['required'],
            'category_id'=>['required',Rule::exists('categories','id')]
        ]);
        $formData['user_id']=auth()->id();
        $formData['thumbnail']=request()->file('thumbnail')->store('thumbnails');
        Blog::create($formData);

        return redirect('/');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        
        return back();
    }

    public function edit(Blog $blog)
    {
        return view('bensai.blogs.edit',[
            'categories'=>Category::all(),
            'blog'=>$blog
        ]);
    }
    
    public function update(Blog $blog)
    {
        $formData=request()->validate([
            'title'=>['required'],
            'slug'=>['required',Rule::unique('blogs','slug')->ignore($blog->id)],
            'intro'=>['required'],
            'body'=>['required'],
            'category_id'=>['required',Rule::exists('categories','id')]
        ]);
        $formData['user_id']=auth()->id();
        $formData['thumbnail']=request()->file('thumbnail') ? request()->file('thumbnail')->store('thumbnails') 
                                                            : $blog->thumbnail;
        $blog->update($formData);

        return redirect('/');
    }

}
