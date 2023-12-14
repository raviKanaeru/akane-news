<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardNewsController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardAccountController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardFeedbackController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('guest');

Route::get('/news', [NewsController::class, 'index'])->middleware('guest');

Route::get('/news/{news:slug}', [NewsController::class, 'show']);

Route::get('/category', [CategoryController::class, 'index'])->middleware('guest');

Route::get('/contact', [ContactController::class, 'index'])->middleware('guest');
Route::post('/contact', [ContactController::class, 'store'])->middleware('guest');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/dashboard/news/checkSlug', [DashboardNewsController::class, 'checkSlug'])->name('checkSlug')->middleware('auth');
Route::get('/dashboard/categories/checkSlug', [DashboardCategoryController::class, 'checkSlug'])->name('checkSlug')->middleware('auth');

Route::resource('/dashboard/news', DashboardNewsController::class)->middleware('auth')->names([
    'index' => 'dashboard.news.index',
    'destroy' => 'dashboard.news.delete'
]);
Route::resource('/dashboard/categories', DashboardCategoryController::class)->middleware('auth')
    ->names([
        'index' => 'dashboard.categories.index',
        'store' => 'dashboard.categories.store',
        'edit' => 'dashboard.categories.edit',
        'update' => 'dashboard.categories.update',
        'destroy' => 'dashboard.categories.delete'
    ])->except('create', 'show');
Route::resource('/dashboard/users', DashboardUserController::class)->middleware('auth')
    ->names([
        'index' => 'dashboard.users.index',
        'store' => 'dashboard.users.store',
        'show' => 'dashboard.users.show',
        'edit' => 'dashboard.users.edit',
        'update' => 'dashboard.users.update',
        'destroy' => 'dashboard.users.delete',
    ])->except('create');

Route::get('/dashboard/account', [DashboardAccountController::class, 'index'])->middleware('auth')->name('account');
Route::resource('/dashboard/feedback', DashboardFeedbackController::class)->middleware('auth')
    ->names([
        'index' => 'dashboard.feedback.index',
        'show' => 'dashboard.feedback.show',
        'destroy' => 'dashboard.feedback.delete',
    ])->except('create');
