<?php

namespace App\Http\Controllers;

use App\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::get();
        
        return view('backend.tag.index',compact('tags'))->with('title','Tag Page');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tag.create_modal')->with('title','Add Tag');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.unique' => 'tag name has already been taken.',
        ];

        $validatedData = $request->validate([
            'name' => 'required|unique:tags|max:50',
        ],$messages);
        
        $validatedData['slug'] = Str::slug($request->name);
        
        Tag::create($validatedData);
        Toastr::success('tag data has been added.');
        return redirect()->back();
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
        $tag = Tag::find($id);
        return view('backend.tag.edit_modal',compact('tag'))->with('title','Edit Tag');
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
        $messages = [
            'name.unique' => 'tag name has already been taken.',
        ];

        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:50',
        ],$messages);

        $validatedData['slug'] = Str::slug($request->name);

        Tag::whereId($id)->update($validatedData);
        Toastr::success('tag data has been edited.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function delete($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        Toastr::success('tag data has been deleted.');
        return redirect()->back();
    }
}
