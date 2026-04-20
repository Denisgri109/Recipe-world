<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect the user to Google's OAuth consent screen.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Unable to authenticate with Google. Please try again.');
        }

        // Check if a user with this Google ID already exists
        $user = User::where('google_id', $googleUser->getId())->first();

        if (!$user) {
            // Check if a user with this email already exists (link accounts)
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Link existing account with Google
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
            } else {
                // Create a brand new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'email_verified_at' => now(),
                ]);
            }
        } else {
            // Update avatar on each login
            $user->update([
                'avatar' => $googleUser->getAvatar(),
            ]);
        }

        Auth::login($user, true);

        return redirect()->intended('/home');
    }
}
