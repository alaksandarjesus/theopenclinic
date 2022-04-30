<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pharmacy\Category;
use App\Http\Requests\Pharmacy\CategoryRequest;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index(){

        $categories = Category::orderBy('name', 'ASC')->get();

        return view('pharmacy.categories.index', compact('categories'));
    }

    public function store(CategoryRequest $request){
        $validated = (object) $request->validated();
        $category = new Category;
        $category->uuid = Str::uuid();
        $category->name = $validated->name;
        $category->created_by = $request->user->id;
        $category->save();

        return response()->json(['redirect' => url('/pharmacy/categories')]);
    }

    public function update(CategoryRequest $request){
        $validated = (object) $request->validated();
        $category = Category::where('uuid', $validated->uuid)->first();
        $category->name = $validated->name;
        $category->updated_by = $request->user->id;
        $category->save();

        return response()->json(['redirect' => url('/pharmacy/categories')]);
    }

    public function delete($uuid, Request $request){
        $category = Category::where('uuid', $uuid)->first();
        if(empty($category)){
            $err = [
                'message' => 'Missing category',
                'errors' => ['Unidentified Rolename']
            ];
            return response()->json($err, 422);
        }

        $err = [
            'message' => 'Missing category',
            'errors' => ['to check if any drug is connected. If yes, drug to be removed']
        ];
        return response()->json($err, 422);

        // todo: to check if any drug is connected. If yes, drug to be removed
        $category->deleted_by = $request->user->id;
        $category->save();
        $category->delete();
        return response()->json(['redirect' => url('/pharmacy/categories')]);
    }
}
