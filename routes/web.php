<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [PageController::class, 'index'])->name('home');

Route::get('/all-events', [EventController::class, 'index'])->name('all-events');
Route::get('/all-news', [NewsController::class, 'index'])->name('all-news');

Route::get('/event/{id}', [EventController::class, 'show'])->name('event.show');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/events', [AdminController::class, 'events'])->name('admin.events');
    Route::get('/news', [AdminController::class, 'news'])->name('admin.news');

    Route::post('/events/create', [AdminController::class, 'createEvent'])->name('admin.events.create');
    Route::post('/events/update/{id}', [AdminController::class, 'updateEvent'])->name('admin.events.update');
    Route::delete('/events/delete/{id}', [AdminController::class, 'deleteEvent'])->name('admin.events.delete');

    Route::post('/news/create', [AdminController::class, 'createNews'])->name('admin.news.create');
    Route::post('/news/update/{id}', [AdminController::class, 'updateNews'])->name('admin.news.update');
    Route::delete('/news/delete/{id}', [AdminController::class, 'deleteNews'])->name('admin.news.delete');
});

Auth::routes(['register' => false]);
