<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        // this will show all the data that was submitted in the form
       //dd(request()->all());

        /* 
            validate the request - if the validation succeeds, the validated data will be returned, otherwise an exception will be thrown. We can save the data to a variable and use it to create the user
        */

        $validatedAttributes = request()->validate([
            'first_name' => ['required', 'min:2'],
            'last_name' => ['required', 'min:2'],
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required', Password::min(6), 'confirmed'], // password_confirmation - the confirmed rule looks for a field with the same name as the field being validated, but with _confirmation appended to it
        ]);


        // create the user
        // the create method will return the user instance that was created and saved to the database. We can save this to a variable and use it to log in the user
        $user = User::create($validatedAttributes);

        //  log in
        Auth::login($user);

        // redirect
        return redirect('/jobs');
    }
}
