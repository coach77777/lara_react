<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
   public function AllCat()
   {

    // Eloquent ORM way 1---------------------------------------------------
    // $categories = Category::all();
    //  $categories = Category::latest()->get();
     // ADDING PAGINATION............................................
     $categories = Category::latest()->paginate(5);

     $trachCat = Category::onlyTrashed()->latest()->paginate(3);


    // Query Builder way---------------------------------------------------
    // $categories = DB::table('categories')->latest()->get();
    //  $categories = DB::table('categories')->latest()->paginate(5);
    //  $categories = DB::table('categories')
    //  ->join('users', 'categories.user_id', 'users.id')
    //  ->select('categories.*', 'users.name')
    //  ->latest()->paginate(5);


       return view('admin.category.index', compact('categories', 'trachCat'));
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

   public function Edit($id)
   {
    // Eloquent ORM way 1---------------------------------------------------
    // $categories = Category::find($id);

    // Query Builder way---------------------------------------------------
    $categories = DB::table('categories')->where('id', $id)->first();

    return view('admin.category.edit', compact('categories'));
   }

    public function Update(Request $request, $id)
    {
// Eloquent ORM way 1---------------------------------------------------
//    $update = Category::find($id)->update([
//     'category_name' => $request->category_name,
//     'user_id' => Auth::user()->id,
//    ]);

// Query Builder way---------------------------------------------------
$data = array();
$data['category_name'] = $request->category_name;
$data['user_id'] = Auth::user()->id;
DB::table('categories')->where('id', $id)->update($data);


     return Redirect()->route('all.category')->with('success', 'Category Updated Successfully');
   }
   public function SoftDelete($id)
   {
// Eloquent ORM way 1---------------------------------------------------
    $delete = Category::find($id)->delete();

    return Redirect()->back()->with('success', 'Category Soft Deleted Successfully');
   }

   public function Restore($id)
   {
    // Eloquent ORM---------------------------------------------------

    $delete = Category::withTrashed()->find($id)->restore();

    return Redirect()->back()->with('success', 'Category Restored Successfully');
   }

public function PDelete($id)
{
    // Eloquent ORM---------------------------------------------------
    $delete = Category::onlyTrashed()->find($id)->forceDelete();

    return Redirect()->back()->with('success', 'Category Permanently Deleted Successfully');

}

}
