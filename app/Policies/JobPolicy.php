<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
    public function edit_policy(User $user, Job $job):Response
    {
        return $job->employer->user->is($user)
            ? Response::allow()
            : Response::deny('You do not own this job.');
    }

    public function delete_policy(User $user, Job $job):Response
    {
        return $job->employer->user->is($user) && $job->employer->user->email === 'armstrong.kimberly@example.org'
            ? Response::allow()
            : Response::deny('You do not own this job.');
    }

}
