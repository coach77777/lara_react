<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('welcome');
});

//Category Controller
Route::get('/category/all', [CategoryController::class,'AllCat'])->name('all.category');

Route::post('/category/add', [CategoryController::class,'AddCat'])->name('store.category');




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
