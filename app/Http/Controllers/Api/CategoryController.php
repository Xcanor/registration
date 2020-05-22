<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('childs')->whereNull('parent_id')->get();
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category =  Category::create($request->all());
        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return $category;
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
        $category = Category::find($id);

        if(!$category)
        {
            return response()->json(['data'=>[],'status'=>404,'message'=>'Category Not Found'],404);
        }
        $category->update($request->all());
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if(!$category)
        {
            return response()->json(['data'=>[],'status'=>404,'message'=>'Category Not Found'],404);
        }

        if($category->delete())
        {
            return response()->json(['data'=>[],'status'=>200,'message'=>'Category Deleted'],200);
        }else
        {
            return response()->json(['data'=>[],'status'=>500,'message'=>'Something Wrong'],500);
        }
        
    }
}
