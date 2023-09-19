@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <h1 class="visually-hidden"></h1>

    <div class="container px-4 py-5" id="featured-3">
        <h2 class="pb-2 border-bottom">All Posts</h2>
        @if (isset($posts) && $posts->count() > 0)
            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                @foreach ($posts as $post)
                    <div class="feature col">
                        <h3 class="fs-2 text-body-emphasis">{{ $post->title ?? '' }}</h3>
                        <p>{{ Str::limit($post->details, 190, '...') }}</p>
                        <a href="{{ route('post.details', $post->id) }}" class="icon-link"> Details
                            <svg class="bi">
                                <use xlink:href="#chevron-right" />
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12 text-end">
                    {{ $posts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @else
            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                <div class="feature col">
                    No Posts are available now.
                </div>
            </div>
        @endif
    </div>
@endsection
