<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;


Route::view('/', 'home');
Route::view('/contact', 'contact');

// Job routes
//Route::resource('jobs', JobController::class)->middleware('auth');
Route::get('/jobs', [JobController::class, 'index']);

Route::get('/jobs/create', [JobController::class, 'create']);

Route::post('/jobs', [JobController::class, 'store'])
->middleware('auth')
->can('edit-job', 'job');

Route::get('/jobs/{job}', [JobController::class, 'show']);

Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
->middleware('auth')
->can('edit-job', 'job');

Route::put('/jobs/{job}', [JobController::class, 'update'])
->middleware('auth')
->can('edit-job', 'job');

Route::delete('/jobs/{job}', [JobController::class, 'destroy'])
->middleware('auth')
->can('edit-job', 'job');


// Auth routes
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);


Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destory']);

