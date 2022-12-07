<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    // when `NewsletterController::class` is passed as the function,
    // PHP will call the __invoke() function automatically.
    public function __invoke(Newsletter $newsletter)
    {
      request()->validate([
        'email' => ['required', 'email'],
      ]);

      try {
        $newsletter->subscribe(request('email'));
      } catch (\Throwable $e) {
        throw ValidationException::withMessages([
          'email' => 'This email address could not be added to our newsletter list.'
        ]);
      }

      return redirect('/')->with('success', 'You are now signed up for our newslsetter.');
    }
}
