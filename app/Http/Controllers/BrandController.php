<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use App\Models\Multipic;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
   public function AllBrand(){

    $brands = Brand::latest()->paginate(5);

       return view('admin.brand.index', compact('brands'));
   }


   public function StoreBrand(Request $request){
       $validated = $request->validate([
           'brand_name' => 'required|unique:brands|min:5',
           'brand_image' => 'required|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
       ],
       [
           'brand_name.required' => 'Please Input Brand Name',
           'brand_name.min' => 'Brand name should be at least 5 characters',
       ]);

     $brand_image = $request->file('brand_image');

//          $name_gen = hexdec(uniqid());
//          $img_ext = strtolower($brand_image->getClientOriginalExtension());
//          $img_name = $name_gen.'.'.$img_ext;
// // $name_gen = hexdec(uniqid()).'.'.strtolower($brand_image->getClientOriginalExtension());
//          $up_location = 'image/brand/';
//          $last_img = $up_location.$img_name;
//          $brand_image->move($up_location, $img_name);

$name_gen = hexdec(uniqid()).'.'.($brand_image->getClientOriginalExtension());
Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

$last_img = 'image/brand/'.$name_gen;


         Brand::insert([
              'brand_name' => $request->brand_name,
              'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);

       return Redirect()->back()->with('success', 'Brand inserted successfully');
   }

   public function Edit($id){
       $brands = Brand::find($id);

       return view('admin.brand.edit', compact('brands'));
   }

   public function Update(Request $request, $id){
       $validated = $request->validate([
           'brand_name' => 'required|min:5',
       ],
       [
           'brand_name.required' => 'Please Input Brand Name',
        'brand_name.min' => 'Brand name should be at least 5 characters',
       ]);

       $old_image = $request->old_image;

       $brand_image = $request->file('brand_image');

       if($brand_image){
         $name_gen = hexdec(uniqid());
         $img_ext = strtolower($brand_image->getClientOriginalExtension());
         $img_name = $name_gen.'.'.$img_ext;
// $name_gen = hexdec(uniqid()).'.'.strtolower($brand_image->getClientOriginalExtension());

            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location, $img_name);

            unlink($old_image);

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                    'created_at' => Carbon::now()
                ]);

        return Redirect()->route('all.brand')->with('success', 'Brand updated successfully');
        }else{
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                    'created_at' => Carbon::now()
                ]);

        return Redirect()->route('all.brand')->with('success', 'Brand updated successfully');
        }
    }

    public function Delete($id){

        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();

        return Redirect()->back()->with('success', 'Brand Deleted successfully');
    }

    //  this is for multi image
    public function Multpic(){

        $images = Multipic::all();

        return view('admin.multipic.index', compact('images'));
    }

    public function StoreImg(Request $request)
    {
        // Ensure the request contains images
        if (!$request->hasFile('image')) {
            return Redirect()->back()->with('error', 'No images were uploaded.');
        }

        $images = $request->file('image');

        // Ensure the input is an array, if not, make it an array
        if (!is_array($images)) {
            $images = [$images];
        }

        foreach ($images as $multi_img) {
            $name_gen = hexdec(uniqid()) . '.' . $multi_img->getClientOriginalExtension();
            Image::make($multi_img)->resize(200, 200)->save('image/multi/' . $name_gen);

            $last_img = 'image/multi/' . $name_gen;

            Multipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
        }

        return Redirect()->back()->with('success', 'Images inserted successfully');
    }

}
