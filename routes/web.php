<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

// // Route::get('/category',[CategoryController::class, 'insert'])->middleware('userauth');
// Route::get('/category', function () {
//     return view('/category');
// })->middleware('userauth');

Route::group(['middleware' => ['auth', 'userauth']], function () {

    Route::get('/category',[CategoryController::class, 'show']);
    Route::post('/category',[CategoryController::class, 'insert']);

});
