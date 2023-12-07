<?php

use App\Http\Controllers\AdminBookController;
use App\Http\Controllers\AdminRentBooksController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentBookController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('rent-books', [BookController::class, 'index'])->name('rent-books');
    Route::get('rent-book/{id}', [BookController::class, 'show'])->name('books.show');
    Route::delete('rent-book/{id}', [RentBookController::class, 'destroy'])->name('rent-book.destroy');
    Route::post('rent-book/{id}', [RentBookController::class, 'store'])->name('rent-book.store');
    Route::get('books-user', [BookController::class, 'showBooksUser'])->name('show-books-user');
});

Route::middleware(['middleware' => 'admin'])->group(function () {
    Route::resource('admin/books', AdminBookController::class);
    Route::get('admin/rent-books', [AdminBookController::class, 'index'])->name('admin.rent-books');
    Route::post('admin/rent-book/{id}', [AdminRentBooksController::class, 'store'])->name('admin.rent-book.store');
    Route::delete('admin/rent-book/{id}', [AdminRentBooksController::class, 'destroy'])->name('admin.rent-book.destroy');
});

require __DIR__ . '/auth.php';
