<?php

use App\Http\Controllers\FacebookLogin\FacebookAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhotoAlbums\AlbumController;
use App\Services\FbApiToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('test', function (){
    $client_id = env('FACEBOOK_CLIENT_ID');
    $app_secret = env('FACEBOOK_CLIENT_SECRET');

    $response = FbApiToken::getAccessToken($client_id,$app_secret);
    var_dump($response);
});

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/facebook/redirect',[FacebookAuthController::class,'handleFacebookRedirect'])->name('auth.fb_redirect');

Route::get('auth/facebook/callback',[FacebookAuthController::class,'handleFacebookCallback'])->name('auth.fb_callback');

Route::resource('albums',AlbumController::class);
Route::resource('album_photos',AlbumController::class);

Auth::routes();


