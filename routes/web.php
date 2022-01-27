<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::group(['middleware' => ['auth', 'userauth']], function () {

    // For categories
    Route::get('/category',[CategoryController::class, 'show']);
    Route::post('/category',[CategoryController::class, 'insert']);
    Route::get('/edit_category/{id}',[CategoryController::class, 'edit'])->name('edit_category');
    Route::put('/edit_category',[CategoryController::class, 'update']);
    Route::get('/delete_category/{id}',[CategoryController::class, 'delete'])->name('delete_category');
    Route::get('/category_trash',[CategoryController::class, 'trash']);
    Route::get('/deleted_category/{id}',[CategoryController::class, 'forchDelete']);
    Route::get('/restore_category/{id}',[CategoryController::class, 'restore']);

    // For Products
    // Route::get('/product',[ProductController::class, 'show']);
    // Route::get('/product/detail/{id}',[ProductController::class, 'detail']);
    // Route::post('/product/add', [ProductController::class, 'insert'])->name('product.add');

});


Route::prefix('product')   
    ->name('product.')
    ->controller(ProductController::class)
    ->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('detail', 'detail')->name('detail');
        Route::get('create', 'create')->name('create');
        Route::post('created', 'created')->name('created');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('edited', 'edited')->name('edited');
        Route::delete('delete/{id}', 'delete')->name('delete');
    });