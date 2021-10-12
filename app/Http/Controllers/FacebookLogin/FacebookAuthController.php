<?php

namespace App\Http\Controllers\FacebookLogin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class FacebookAuthController extends Controller
{
    CONST DRIVER_TYPE = 'facebook';

    /**
     * @return RedirectResponse
     */
    public function handleFacebookRedirect()
    {
        return Socialite::driver(static::DRIVER_TYPE)->redirect();
    }


    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver(static::DRIVER_TYPE)->user();

            $user_existed = User::where('oauth_id',$user->id)
                            ->where('oauth_type', static::DRIVER_TYPE)
                            ->first();

            if( $user_existed ) {
                Auth::login($user_existed);
                return redirect()->route('home');

            } else {

                $new_user = User::create([
                    'name'           =>   $user->getName(),
                    'email'          =>   $user->getEmail(),
                    'oauth_id'       =>   $user->getId(),
                    'oauth_type'     =>   static::DRIVER_TYPE,
                    'password'       =>   Hash::make($user->id),
                    'avatar'         =>   $user->getAvatar()
                ]);

                Auth::login($new_user);
                return redirect()->route('home');
            }

        }catch (\Exception $exception){
            return redirect()
                ->back()
                ->with('error_string',$exception->getMessage());
        }
    }
}
