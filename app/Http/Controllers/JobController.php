<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Mail\JobPosted;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    //

    public function index()
    {
        $jobs = Job::with('employer')->latest()->paginate(10);

        return view('jobs.index', ['jobs' => $jobs]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    // creating a new job
    public function store()
    {
        // validation...

        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        // create the job and save to the database
        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => Auth::user()->id
        ]);

        // send an email to the user who created the job
        // if there are no workers assigned to queue, we can manually run it using "php artisan queue:work"
        Mail::to($job->employer->user)->queue(
            new JobPosted($job)
        );
        
        // redirect back to the jobs page
        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        //Gate::authorize('edit-job', $job); // using the gate defined in AppServiceProvider. This is the same as using the authorize method in the controller action. The gate will check if the authenticated user is the owner of the job. If the gate check fails, a 403 Forbidden response will be returned.

        // there are also can() and cannot() methods on the user model that are specific to authorization. These methods can be used to check if a user can perform a specific action. The can() method returns true if the user can perform the action, and false if they cannot. We can perform the same check as the gate above using the cannot() method like so:
        
        // if (Auth::user()->cannot('edit-job', $job)){ dd('failure'); }

        // validation...

        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        Gate::authorize('delete-job', $job);

        // delete the job
        $job->delete();

        // redirect
        return redirect('/jobs');
    }


}
