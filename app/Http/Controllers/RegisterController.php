<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
      return view('register.create');
    }

    public function store()
    {
      // for a complete list of all validation rules:
      // https://laravel.com/docs/9.x/validation#available-validation-rules

      // if validation fails, laravel redirects the user back to the registration page
      $attributes = request()->validate([
        'name' => ['required', 'max:255'],
        'username' => ['required', 'max:255', 'min:3', Rule::unique('users', 'username')],
        'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
        'password' => ['required', 'min:7', 'max:255']
      ]);

      $user = User::create($attributes);

      auth()->login($user);

      // add a flash session message
      return redirect('/')->with('success', 'Your account has been created.');
    }
}
