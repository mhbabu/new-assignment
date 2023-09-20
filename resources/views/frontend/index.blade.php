@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <div class="container">
        <h2 class="pb-2 border-bottom">All Posts</h2>
        <div class="row mt-5">
            @if (isset($posts) && $posts->count() > 0)
                @foreach ($posts as $post)
                    <div class="col-md-4">
                        <h2>{{ $post->title ?? '' }}</h2>
                        <p>{{ Str::limit($post->details, 190, '...') }}</p>
                        <p>
                            <a class="btn btn-secondary" href="{{ route('post.details', $post->slug) }}" role="button">Details &raquo;</a>
                        </p>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-md-12">
                        {{ $posts->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @else
                <div class="col-md-12 mx-auto">
                    No Posts are available now.
                </div>
            @endif
        </div>
    </div>
@endsection

