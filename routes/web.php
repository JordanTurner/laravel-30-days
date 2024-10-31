<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use App\Models\Job;


// Asset Bundling - combining multiple CSS and JS files into a single file to reduce the number of requests made to the server

// there is a package.json file in the root that contains the front end dependencies. To install the dependencies, run npm install. This will create a node_modules directory in the root of the project. To compile the assets, run npm run dev. This will compile the assets and place them in the public directory. To watch for changes and automatically compile the assets, run npm run watch.

// node.js and npm are required to run the above commands. If you don't have them installed, you can download them from the node.js website.

// npm install will install the dependencies listed in the package.json file. The dependencies are installed in the node_modules directory. The node_modules directory is not committed to the repository because it can be quite large. Instead, the package.json file is committed to the repository. When you clone the repository, you can run npm install to install the dependencies.

// when we run npm run dev, Laravel Mix will compile the assets and place them in the public directory. The compiled assets are versioned, which means that the file names are suffixed with a hash of the file contents. This is done to ensure that the browser always fetches the latest version of the assets. The versioned assets are stored. NPM will use the APP_URL from the env file, so we need to set that to the correct URL. By default it is http://localhost. For this project I have changed it to http://127.0.0.1:8000.

// We have also installed Tailwind, rather than inculding it from the CDN. This is because we can use the Tailwind CLI to purge unused CSS classes. This will reduce the size of the CSS file. To install Tailwind for Laravel, we can follow this command: https://tailwindcss.com/docs/guides/laravel, which will give us a tailwind.config.js file. We need to populate the contents array to tell tailwind where to find any utility classes. The above link has some recommended settings. We will then add the tailwind directive to our css file. e.g. 
// @tailwind base;
// @tailwind components;
// @tailwind utilities;

// start the build process with npm run dev


// we can also configure tailwind to e.g. create a custom color

//   theme: {
//     extend: {
//         colors: {
//           "laracasts": "rgb(50, 138, 241)"
//         }
//       },
//     },


//  we created a custom colour called laracase. We can now use this in our css file like so: text-laracasts-500. We've done this on the jobs page for the job title.


// vite run build will build the assets for production. This will minify the assets and remove any unused CSS classes. This will create a dist directory in the root of the project. The dist directory contains the compiled assets. The dist directory is not committed to the repository because it can be quite large. Instead, the dist directory is added to the .gitignore file. When you deploy the application, you can run npm run build to build the assets for production.


Route::get('test', function () {
    
    // dispatching a job to the queue (queued closure)
    // this will queue the job (jobs table in database). To run the job, run the queue worker: php artisan queue:work
    // dispatch(function(){
    //     logger('Hello from the queue');
    // });

    // you can also delay the job using the delay() method

    // dispatch(function(){
    //     logger('Hello from the queue');
    // })->delay(now()->addMinutes(10));


    // dispatching a job to the queue (queued class)

    $job = Job::find(1);
    TranslateJob::dispatch($job);

    return 'Done';

});


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


// if we used a Route::resource() for the jobs controller with auth middleware, we need to define a name for the login route, otherwise the login form will not work. Laravel is looking for a route named 'login'.
Route::get('/login', [SessionController::class, 'create'])->name('login'); // named route - used in the login form
//Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destory']);

