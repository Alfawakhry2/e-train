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

        // Find or create user
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' =>  Hash::make(Str::random(32)),
                'email_verified_at' => now(),
            ]
        );
        if ($user->wasRecentlyCreated) {
            Student::create([
                'user_id' => $user->id,
            ]);
        } else {
            // Ensure student record exists even for existing users
            if (!$user->student) {
                Student::create([
                    'user_id' => $user->id,
                ]);
            }
        }
        Auth::login($user);

        return redirect(url('/dashboard'));
    }



    // public function redirectFacebook()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }

    // public function redirectFacebookCallback()
    // {
    //     $user =  Socialite::driver('facebook')->user();

    // }

    // protected function _registerOrLoginUser($data)
    // {
    //     $user =  User::where("email", '=', $data->email)->first();
    //     if (! $user) {
    //         $user = new User();
    //         $user->name = $data->name;
    //         $user->email = $data->email;
    //         // $user->phone = $data->phone;
    //         // $user->image = $data->avatar;
    //         $user->save();
    //     }
    //     Auth::login($user);
    // }
}
