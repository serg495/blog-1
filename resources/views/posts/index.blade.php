@extends('layouts.app')

@section('content')
    <div class="container w-50">
        @foreach($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">
                        @can('watch full post')
                            <a class="text-dark" href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
                        @else
                            <p class="text-dark">{{ $post->title }}</p>
                        @endcan
                    </h5>
                    <img class="card-img-top" src="{{ optional( $post->getMedia('images')->first())->getUrl('thumb') }}"
                         alt="">
                </div>
                <div class="card-body">
                    <p class="card-text font-italic">{{ $post->summary }}</p>
                    <p class="card-text">
                        {{ str_limit($post->body, round(strlen($post->body) / 100 * 30)), '...' }}
                        @can('watch full post')
                            <a href="{{ route('post.show', $post->id) }}">читать полностью</a>
                        @else
                            <a href="{{ route('login') }}">читать полностью</a>
                        @endcan
                    </p>
                </div>
                <div class="card-body nav justify-content-between">
                    @can('like post')
                        <post-like post_id="{{ $post->id }}" is_liked="{{ $post->isLikedBy(auth()->user()) }}"
                                   likes_count="{{ $post->likesCount() }}">
                        </post-like>
                    @endcan
                    <i class="fa fa-2x fa-eye">
                        {{ $post->viewsCount() }}
                    </i>
                </div>
            </div>
        @endforeach
        <div style="display: flex; justify-content: center">
            {{$posts->links()}}
        </div>
    </div>
@endsection