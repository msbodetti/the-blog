<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RatingsController;
use App\Models\Posts;

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
    return view('welcome', [ 'posts' => Posts::all() ]);
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard', [ 'posts' => Posts::all() ]);
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('posts', PostsController::class)->except([
    'index'
])->missing(function () {
    return Redirect::route('dashboard');
});

Route::resource('ratings', RatingsController::class)->only([
    'store'
])->missing(function () {
    return Redirect::route('dashboard');
});
