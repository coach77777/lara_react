<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
   public function AllCat()
   {

    // Eloquent ORM way 1---------------------------------------------------
    // $categories = Category::all();
    //  $categories = Category::latest()->get();

    // Query Builder way---------------------------------------------------
    $categories = DB::table('categories')->latest()->get();

       return view('admin.category.index', compact('categories'));
   }

   public function AddCat(Request $request)
   {

          $validated = $request->validate([
        'category_name' => 'required|unique:categories|max:255',
          ],

[
        'category_name.required' => 'Please input category name',
        'category_name.max' => 'Category less than 255 chars',
]);

// Eloquent ORM way 1---------------------------------------------------
Category::insert([
    'category_name' => $request->category_name,
    'user_id' => Auth::user()->id,
    'created_at' => Carbon::now()
]);

// Eloquent ORM way 2---------------------------------------------------
// $category = new Category;
// $category->category_name = $request->category_name;
// $category->user_id = Auth::user()->id;
// $category->save();

// Query Builder way---------------------------------------------------
// $data = array();
// $data['category_name'] = $request->category_name;
// $data['user_id'] = Auth::user()->id;
// $data['created_at'] = Carbon::now();
// DB::table('categories')->insert($data);

return Redirect()->back()->with('success', 'Category Inserted Successfully');

   }
}
