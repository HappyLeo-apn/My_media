<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //Direct Category Page
    public function index()
    {
        $categories = Category::get();

        return view('admin.category.index', compact('categories'));
    }

    public function createCategory(Request $request)
    {

        $validator = $this->categoryValidation($request);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $this->getCategoryData($request);
        Category::create($data);
        return back();
    }

    public function deleteCategory($id){


        Category::where('category_id', $id)->delete();
        return back()->with(['deleteSuccess' => "Category was successfully deleted!"]);
    }

    public function searchCategory(Request $request){
        $searchKey = $request->searchKey;
        $categories = Category::orWhere('title', 'like', '%'.$searchKey.'%')
                                ->orWhere('description', 'like', '%'.$searchKey.'%')
                                ->get();
       return view('admin.category.index', compact('categories'));
    }

    public function editPage($id){
        $updateData = Category::where('category_id', $id)->first();

        $categories = Category::get();

    //    return view('admin.category.edit', compact('updateData', 'categories'));
    return view('admin.category.editPage', compact('updateData', 'categories'));

    }

    public function updateCategory(Request $request, $id){

        $validator = $this->categoryValidation($request);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $this->getUpdatedData($request);
        Category::where('category_id', $id)->update($data);
        return back()->with(['categoryUpdated' => 'Category data was updated successfully!']);
    }


    //Private Functions
    private function getCategoryData($request)
    {
        return [
            'title' => $request->categoryName,
            'description' => $request->categoryDesc,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

    private function categoryValidation($request)
    {
        $validationMessage = [
            'categoryDesc' => 'Description is required!',
            'categoryDesc.min' => 'Description must be at least 5 characters long'
        ];
        $validationRule = [
            'categoryName' => 'required|min:5',
            'categoryDesc' => 'required|min:5'
        ];
        return  Validator::make(
            $request->all(),
            $validationRule,
            $validationMessage

        );
    }

    private function getUpdatedData($request){
        return [
            'title' => $request->categoryName,
            'description' => $request->categoryDesc
        ];
    }
}
