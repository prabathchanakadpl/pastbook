<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class FacebookAuthController extends Controller
{
    CONST DRIVER_TYPE = 'facebook';

    /**
     * Send request to facebook graph api to login
     * @return RedirectResponse
     */
    public function handleFacebookRedirect(): RedirectResponse
    {
        return Socialite::driver(static::DRIVER_TYPE)->redirect();
    }


    /**
     * check authenticated user exist with our db
     * if user exist, then logged in that user to the system
     * if not then, saved authenticated user in db
     * and logged in that user to the system
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleFacebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();

            if($isUser){
                Auth::login($isUser);
                return redirect('/home');
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'password' => encrypt('admin@123')
                ]);

                Auth::login($createUser);
                return redirect('/home');
            }

        } catch (\Exception $exception) {
            return redirect()
                ->route('login')
                ->with('error_string','Authentication Failed!!!');
        }
    }
}
