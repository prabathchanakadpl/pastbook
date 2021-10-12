<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FbApiToken
{
    public static function getAccessToken($client_id,$app_secret)
    {
        return  Http::get("https://graph.facebook.com/oauth/access_token",
            [
                'client_id' => $client_id,
                'client_secret' => $app_secret,
                'grant_type' => 'client_credentials'
            ]
        )->json('access_token');


    }
}
