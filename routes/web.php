<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', \App\Livewire\Home::class)->name('home');

Route::get('article/{article:slug}', \App\Livewire\Article\Show::class)->name('article.show');

Route::get('profile/{user:username}', \App\Livewire\User\Show::class)->name('user.show');

Route::get('login', \App\Livewire\Login::class)
    ->middleware(['guest'])
    ->name('login');

Route::get('register', \App\Livewire\Register::class)
    ->middleware(['guest'])
    ->name('register');

Route::get('settings', \App\Livewire\User\Setting::class)->name('user.setting');

Route::name('article.')->group(function () {
    Route::get('article', \App\Livewire\Article\Create::class)->name('create');

    Route::get('article/edit/{article}', \App\Livewire\Article\Edit::class)->name('edit');
});
