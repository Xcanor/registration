<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {   
        $categories = Category::all();
        return view('auth.category.pages.dashboard',compact('categories'));
    }

    public function create()
    {
        return view('auth.category.pages.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        
        $category =  Category::create([
            'name' => $request['name'],
        ]);

        return redirect('admin/dashboard/category');
    }

    public function edit($categoryId)
    {
        $category = Category::findOrFail($categoryId); //primary Key
        return view('auth.category.pages.edit',compact('category'));

    }

    // admin update user's data
    public function update(Request $request)
    {
        // get data of old User
        $category = Category::findOrFail($request->categoryId);
        // validate updated data
        $this->validate($request, [
            'name' => 'required',
        ]);
        // save new values
        $category -> name = $request -> name;
        $category -> save();

        return redirect('/admin/dashboard/category');
    }

    public function show($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return view('auth.category.pages.show', compact('category'));
    }

    public function destroy($categoryId)
    {
        $category = Category::findOrFail($categoryId); //primary Key
        $category->delete();
        return redirect()->back();

    }
}
