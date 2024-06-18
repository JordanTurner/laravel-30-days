<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Job;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading();

        // Define the edit-job gate. This gate will check if the authenticated user is the owner of the job.
        // the $user passed to the gate here is always the signed in user (Auth::user()). This means we do not need to check for Auth::user() in the route, or anywhere else
        // that will use this gate
        // Gate::define('edit-job', function (User $user, Job $job) {
        //     return $job->employer->user->is($user);
        // });

        // hardcoding the email address for the employer here just to have a different condition for for the delete-job gate
        Gate::define('delete-job', function (User $user, Job $job) {
            return $job->employer->user->is($user) && $job->employer->user->email === 'armstrong.kimberly@example.org';
        });

        //Paginator::useBootstrapFive();
    }
}
