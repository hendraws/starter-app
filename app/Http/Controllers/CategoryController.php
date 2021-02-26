<?php

namespace App\Http\Controllers;

use App\Category;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
    
        return view('backend.category.index',compact('categories'))->with('title','Category Page');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create_modal')->with('title','Add Category');
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
            'name.unique' => 'category name has already been taken.',
        ];

        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:50',
        ],$messages);

        $validatedData['slug'] = Str::slug($request->name);
        
        Category::create($validatedData);
        Toastr::success('category data has been added.');
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
        $category = Category::find($id);
        return view('backend.category.edit_modal',compact('category'))->with('title','Edit Category');
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
            'name.unique' => 'category name has already been taken.',
        ];

        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:50',
        ],$messages);

        $validatedData['slug'] = Str::slug($request->name);

        Category::whereId($id)->update($validatedData);
        Toastr::success('category data has been edited.');
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
        $category = Category::findOrFail($id);
        $category->delete();
        Toastr::success('category data has been deleted.');
        return redirect()->back();
    }
}
