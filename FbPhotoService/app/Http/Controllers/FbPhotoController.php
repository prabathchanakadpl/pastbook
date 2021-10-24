<?php

namespace App\Http\Controllers;

use App\Models\FbPhoto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class FbPhotoController extends Controller
{
    /**
     * Return all stored user photos
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(FbPhoto::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fb_photo = FbPhoto::updateOrCreate([
            //Add unique field combo to match here
            'user_id'   => $request->get('user_id'),
        ],[
            'title'     => $request->get('title'),
            'picture'   => $request->get('picture'),
            'user_id'   => $request->get('user_id'),
        ]);

        return response($fb_photo,Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     * @param $fbPhoto_id
     * @return FbPhoto
     */
    public function show($fbPhoto_id)
    {
        return FbPhoto::findOrFail($fbPhoto_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\FbPhoto  $fbPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FbPhoto $fbPhoto)
    {
        $fbPhoto->update($request->only('title','picture'));

        return response($fbPhoto,Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     * @param FbPhoto $fbPhoto
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(FbPhoto $fbPhoto)
    {
        $fbPhoto->delete();

        return response(null,Response::HTTP_NO_CONTENT);
    }
}
