<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use App\Models\Job;

// Route::get('test', function () {
    
//     $jobs = Job::all();

//     dd($jobs[0]);

//     // $job = \App\Models\Job::first();

//     // TranslateJob::dispatch($job);

//     // return 'Done';

// });


/*
     Route::view() is a helper function that returns a view. It takes two arguments: the URI and the view name. In this case, the URI is / and the view name is home. This means that when a user visits the root URL of the application, they will see the home view. If all we need to do is return a view, we can use Route::view() instead of Route::get().
*/
Route::view('/', 'home');

Route::view('/contact', 'contact');


// Job routes

/* 
    Route Groups - controller actions can be grouped together using Route::controller for slighly cleaner code.

    Route::controller(JobController::class)->group(function(){
        Route::get('/jobs', 'index');
        Route::get('/jobs/create', 'create');
        Route::post('/jobs', 'store');
        Route::get('/jobs/{job}', 'show');
        Route::get('/jobs/{job}/edit', 'edit');
        Route::patch('/jobs/{job}', 'update');
        Route::delete('/jobs/{job}', 'destroy');
    });
*/

/* 
    Route::resource() - a shorthand method for creating routes that follow the RESTful pattern. It creates routes for all the common actions in a controller: index, create, store, show, edit, update, and destroy. 

    Route::resource('jobs', JobController::class);

    with middleware:
    Route::resource('jobs', JobController::class)->middleware('auth');


    you can also specify which controller actions to use for each route by passing an array as the second argument to Route::resource(). The keys in the array are the route names, and the values are the controller actions.

    Route::resource('jobs', JobController::class)->only(['index', 'show']);

    or exclude certain routes:

    Route::resource('jobs', JobController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);
*/



Route::get('/jobs', [JobController::class, 'index']);

Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');

Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');

Route::get('/jobs/{job}', [JobController::class, 'show']);

Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
    ->middleware('auth')
    ->can('edit_policy', 'job');

Route::patch('/jobs/{job}', [JobController::class, 'update'])
    ->middleware('auth')
    ->can('edit_policy', 'job');

Route::delete('/jobs/{job}', [JobController::class, 'destroy'])
    ->middleware('auth')
    ->can('edit_policy', 'job');


// Auth routes
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);


Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destory']);

