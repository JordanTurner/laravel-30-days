<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        // validate - if validation fails, we don't have to manually redirect the user back to the login form. Laravel will automatically redirect the user back to the previous page with the errors.
        $attributes = request()->validate([
            'email' => ['required', 'email'], // email must be a valid email address
            'password' => ['required'],
        ]);

        // attempt to login the user. If false is returned from the attempt method, the user will be redirected back to the login form with the error message "Sorry, those credentials do not match."
        if (! Auth::attempt($attributes))
        {
            throw ValidationException::withMessages(['email' => 'Sorry, those credentials do not match.']); // this will display the error message in the email field
        }

        // regenerate the session token
        request()->session()->regenerate(); // this is a security measure to prevent session fixation/hijacking attacks. It will give the user a new session ID every time they log in.

        // redirect
        return redirect('/jobs');

        // research rate limiting. This is a security measure to prevent brute force attacks. If a user tries to log in too many times with the wrong password, they will be locked out for a certain amount of time.

        // research resetting your password
    }

    public function destory()
    {
        // you don't need to pass the user to the logout method, as it will automatically log out the currently authenticated user
        Auth::logout();

        return redirect('/');
    }
}
