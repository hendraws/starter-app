<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use File;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::get();
        
        return view('backend.post.index',compact('posts'))->with('title','Post Page');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $tags       = Tag::get();
        
        return view('backend.post.create',compact('categories','tags'))->with('title','Post Page');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $this->validate($request, [
                    'title'       => 'required',
                    'category_id' => 'required',
                    'content'     => 'required',
                    'image'       => 'required'
                ]);
            
        $image              = $request->image;
        $newImage              = time().$image->getClientOriginalName();
        
        $post = Post::create([
                    'title'       => $request->title,
                    'slug'       => Str::slug($request->title),
                    'category_id' => $request->category_id,
                    'content'     => $request->content,
                    'image'       => 'public/upload/posts/'.$newImage,
                    'user_id'     => Auth::id(),
        ]);
        $post->tags()->attach($request->tags);
        $image->move('public/upload/posts/',$newImage);
        
        Toastr::success('Post data has been added.');
        return Redirect::action('PostController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findorfail($id);
        $categories = Category::get();
        $tags = Tag::get();

        return view('backend.post.edit',compact('categories','tags','post'))->with('title','Edit Post Page');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'title'       => 'required',
            'category_id' => 'required',
            'content'     => 'required',
        ]);
        
        $post = Post::findorfail($id);

        $inputPost = [
                    'title'       => $request->title,
                    'slug'       => Str::slug($request->title),
                    'category_id' => $request->category_id,
                    'content'     => $request->content,
                    'user_id'     => Auth::id(),
                    
        ];

        if($request->has('image')){
            $image                 = $request->image;
            $newImage              = time().$image->getClientOriginalName();
            $image->move('public/upload/posts/',$newImage);
            $inputPost['image'] = 'public/upload/posts/'.$newImage;
            File::delete($post->image);
        }
        $post->tags()->sync($request->tags);
        $post->update($inputPost);
        
        Toastr::success('Post data has been Updated.');
        return Redirect::action('PostController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function trash($id)
    {
        $post = Post::findorfail($id);
        $post->delete();

        Toastr::success('Post data has been move to Trashed.');
        return Redirect::action('PostController@index');
    }
   
    public function recyclebin()
    {   
        $posts = Post::onlyTrashed()->get();
        // dd($post);
        return view('backend.post.recycle_bin',compact('posts'))->with('title','RecycleBin Post Page');
    }

    public function delete($id)
    {
        $post = Post::withTrashed()->whereId($id)->first();
        $post->forceDelete();
        File::delete($post->image);
        Toastr::success('Post data has been Deleted.');
        return Redirect::action('PostController@index');
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->whereId($id)->first();
        $post->restore();
        Toastr::success('Post data has been Restored.');
        return Redirect::action('PostController@index');

    }

}
