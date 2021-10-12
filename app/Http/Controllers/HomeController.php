<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->oauth_id;

        //get user uploded 100 photos
        $response = json_decode(Http::withToken(env('FB_API_TOKEN'))->get("https://graph.facebook.com/$user_id/photos",
            [
                'type' => 'uploaded',
                'limit' => 100,
                'fields' => 'id,picture,created_time'
            ]
        ));

        //convert json response into collection
        $user_photos = collect($response->data);

        // save selected latest 9 photos as user favorites
        $album_photos = $user_photos->sortByDesc('created_time')->take(9);


        self::save_selected_latedt_photos($album_photos);

        return view('home', compact('user_photos', 'album_photos'));
    }

    /**
     * Save given collection of photos
     * @param Collection $collection
     */
    private function save_selected_latedt_photos(Collection $collection)
    {

        try {

            DB::beginTransaction();
            $album = new Album();
            $album->user_id = Auth::id();
            $album->name = uniqid('Album');
            $album->save();

            foreach ($collection as $select_photo) {

                AlbumPhoto::create([
                    'album_id' => $album->id,
                    'picture_id' => $select_photo->id,
                    'picture' => $select_photo->picture,
                ]);

            }

            DB::commit();

            return redirect()->route('home');

        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('home');
        }
    }
}
