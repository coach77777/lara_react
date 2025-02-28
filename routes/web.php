<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;


Route::get('/', function () {
    return view('welcome');
});

//Category Controller
Route::get('/category/all', [CategoryController::class,'AllCat'])->name('all.category');

Route::post('/category/add', [CategoryController::class,'AddCat'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'Edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class,'Update'])->name('category.update');
Route::get('/category/softdelete/{id}', [CategoryController::class,'SoftDelete'])->name('category.softdelete');
Route::get('/category/restore/{id}', [CategoryController::class,'Restore'])->name('category.restore');
Route::get('/category/pdelete/{id}', [CategoryController::class,'PDelete'])->name('category.pdelete');

//Brand Route
Route::get('/brand/all', [BrandController::class,'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class,'StoreBrand'])->name('store.brand');

Route::get('brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');

Route::post('/brand/update/{id}', [BrandController::class, 'Update'])->name('brand.update');
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete'])->name('brand.delete');






Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {

//elooquent ORM
        // $users = User::all();

        // Query Builder
        $users = DB::table('users')->get();

        return view('dashboard', ['users' => $users]); // Correct syntax
    })->name('dashboard');
});
