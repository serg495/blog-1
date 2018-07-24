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
                    <div class="card-body nav justify-content-between">
                        @can('like post')
                            <post-like post_id="{{ $post->id }}" is_liked="{{ $post->isLikedBy(auth()->user()) }}"
                                       likes_count="{{ $post->likesCount() }}">
                            </post-like>
                        @endcan
                        <post-view post_id="{{ $post->id }}" views_count="{{ $post->viewsCount() }}"></post-view>
                    </div>
            </div>
        </div>
    </div>
@endsection