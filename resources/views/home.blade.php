@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    {{ __('Your Favorite Uploads') }}
                    <div class="float-lg-right">
                        <a href="{{route('albums.create')}}" class="btn btn-warning text-dark">Create New Album</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        @foreach($album_photos as $user_photo)
                            <div class="col-sm-4">
                                <img src="{{$user_photo->picture}}" class="img-fluid img-thumbnail"
                                     alt="{{$user_photo->id}}" style="height: 100%;width: 100%;"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
