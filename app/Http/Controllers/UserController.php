<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use phpDocumentor\Reflection\Types\Null_;

class UserController extends Controller
{
    //google
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirectGoogleCallback()
    {
        $googleUser =  Socialite::driver('google')->user();


        //check for existing user (including trashed)
        $user = User::withTrashed()->where('email', $googleUser->getEmail())->first();

        if ($user) {
            if ($user->trashed()) {
                $user->restore();
                $user->update([
                    'name' => $googleUser->getName(),
                    'email_verified_at' => now()
                ]);
            }
        } else {
            // Create new user if doesn't exist
            $user = User::create([
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
                //not used , only not put null value 
                'password' => Hash::make(Str::random(32)),
                'email_verified_at' => now(),
            ]);
        }

        // Handle student record
        if (!$user->student) {
            Student::create([
                'user_id' => $user->id,
            ]);
        } else if ($user->student->trashed()) {
            $user->student->restore();
        }

        Auth::login($user);

        return redirect(url('/dashboard'));
    }




    public function redirectFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function redirectFacebookCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();

        //check for existing user (including trashed)
        $user = User::withTrashed()->where('email', $facebookUser->getEmail())->first();

        if ($user) {
            if ($user->trashed()) {
                $user->restore();
                $user->update([
                    'name' => $facebookUser->getName(),
                    'email_verified_at' => now()
                ]);
            }
        } else {
            // Create new user if doesn't exist
            $user = User::create([
                'email' => $facebookUser->getEmail(),
                'name' => $facebookUser->getName(),
                'password' => Hash::make(Str::random(32)),
                'email_verified_at' => now(),
            ]);
        }

        // Handle student record
        if (!$user->student) {
            Student::create([
                'user_id' => $user->id,
            ]);
        } else if ($user->student->trashed()) {
            $user->student->restore();
        }

        Auth::login($user);

        return redirect(url('/dashboard'));
    }
}
