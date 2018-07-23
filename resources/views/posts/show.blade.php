@extends('layouts.app')

@section('content')
    <div class="container w-50">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">
                    {{ $post->title }}
                </h5>
                <img class="card-img-top" src="{{ optional( $post->getMedia('images')->first())->getUrl('thumb') }}" alt="">
            </div>
            <div class="card-body">
                <p class="card-text font-italic">{{ $post->summary }}</p>
                <p class="card-text">{{ $post->body }}</p>
            </div>
            <div class="card-body nav justify-content-between">
                <span class="glyphicon glyphicon-heart">{{ $post->likes->count() }} likes</span>
                <span class="glyphicon glyphicon-eye-open">{{ $post->views->count() }} views</span>
            </div>
        </div>
    </div>
@endsection