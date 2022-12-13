<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
  public function create()
  {
    return view('sessions.create');
  }

  public function store()
  {
    // validate request (don't be too specific here in order to not give away any clues to malicious actors)
    $attributes = request()->validate([
      'email' => ['required', 'email'],
      'password' => ['required']
    ]);

    if (!auth()->attempt($attributes)) {
      throw ValidationException::withMessages(['email' => 'Your provided credentials could not be verified.']);
    }

    // prevent session fixation
    session()->regenerate();

    return redirect('admin/posts')->with('success', 'Welcome back!');
  }

  public function destroy()
  {
    auth()->logout();

    return redirect('/')->with('success', 'Your are now logged out.');
  }
}
