<?php

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

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
    return Inertia::render('FrontDashboard', [
        'canLogin' => Route::has('login'),
        // 'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'categories' => Category::all()
    ])->withViewData(['meta' => ['title' => 'Selamat Datang di Notebook']]);
});
Route::get('/category/{id}', 'CategoryController@show');
Route::get('/category/{categoryId}/note/{id}', 'NoteController@show');
Route::get('/register', function () {
    return Inertia::render('Error', ['status' => 404])->withViewData(['meta' => ['title' => 'Not Found']]);
})->name('register');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('dashboard');
    Route::resource('/category', CategoryController::class)->except(['show']);
    Route::resource('/note', NoteController::class)->except(['show']);
});
