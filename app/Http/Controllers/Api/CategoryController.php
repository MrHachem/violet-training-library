<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Helpers\ResponseHelper;
use App\Services\Helpers\FileService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories =  Category::all();
       return ResponseHelper::success(' جميع الأصناف',$categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|unique:categories'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return ResponseHelper::success("تمت إضافة الصنف" , $category);
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => "required|max:50|unique:categories,name,$id",
            'image' => ['sometimes', 'nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120']
        ]);

        $fileService = new FileService();
        $category = Category::find($id);

        if ($request->hasFile('image')) {
            if ($category->image) {
                $fileService->deleteFile('public', $category->image);
            }
        
            $image = $request->file('image');
            $category->image = $fileService->storePublicImage($image, 'cat', 400);
        }

        $category->name = $request->name;
        $category->save();
        return ResponseHelper::success("تم تعديل الصنف" , $category);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return ResponseHelper::success("تم حذف الصنف" , $category);
    }
}
