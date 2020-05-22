<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {   
        //$categories = Category::with('childs')->whereNull('parent_id')->get();
        $categories = Category::with('childs')->get();
        return view('auth.category.pages.dashboard',compact('categories'));
    }

    public function create()
    {
        $allCategories = Category::all();
        return view('auth.category.pages.create',compact('allCategories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        
        $category =  Category::create([
            'name' => $request['name'],
            'parent_id' =>  $request['parent_id']
        ]);

        return redirect('admin/dashboard/category');
    }

    public function edit($categoryId)
    {
        $category = Category::findOrFail($categoryId); //primary Key
        $allCategories = Category::all();
        return view('auth.category.pages.edit',compact('category','allCategories'));

    }

    
    public function update(Request $request)
    {
        
        $category = Category::findOrFail($request->categoryId);
        
        $this->validate($request, [
            'name' => 'required',
        ]);
       
        $category -> name = $request -> name;
        $category -> parent_id = $request -> parent_id;
        $category -> save();

        return redirect('/admin/dashboard/category');
    }

    public function show($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return view('auth.category.pages.show', compact('category'));
    }

    public function destroy(Request $request)
    {
        $category = Category::findOrFail($request->category_id);
        $category->delete();
        return response()->json(['message' => 'Record deleted successfully!']);
    } 
}
