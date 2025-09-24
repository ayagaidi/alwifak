<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch the application language
     */
    public function switch(Request $request)
    {
        $locale = $request->input('locale');

        // Validate locale
        if (!in_array($locale, ['ar', 'en'])) {
            $locale = 'ar'; // Default fallback
        }

        // Store the locale in session
        Session::put('locale', $locale);

        // Set the application locale
        App::setLocale($locale);

        // Redirect back to the previous page
        return redirect()->back();
    }

    /**
     * Get the current locale
     */
    public function getCurrentLocale()
    {
        return Session::get('locale', config('app.locale', 'ar'));
    }
}
