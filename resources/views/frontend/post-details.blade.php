@extends('layouts.app')
@section('title', $post->title)
@section('content')
    <div class="container">
        <div class="container">
            <div class="bg-body-tertiary p-3 rounded">
                <div class="col-sm-12 py-3 mx-auto">
                    <h1 class="display-5 fw-normal">{{ $post->title }}</h1>
                    <p>{{ $post->details }}</p>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <p class="text-muted"> Author : <strong>{{ $post->user->name }}</strong></p>
                        <p>Published on :
                            <strong>{{ \Carbon\Carbon::parse($post->created_at)->format('F d, Y') }}</strong>
                            at <strong>{{ \Carbon\Carbon::parse($post->created_at)->format('h:i:s A') }}</strong>
                        </p>
                    </div>
                </div>
            </div>

            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                {!! Form::open(['route' => ['post.comments', $post->id], 'method' => 'post']) !!}
                <div class="card-body">
                    <div class="form-group">
                        <textarea id="comment" class="form-control @error('comment') is-invalid @enderror" name="comment"
                            value="{{ old('comment') }}" required autocomplete="comment" rows="5" autofocus></textarea>
                        @error('comment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary float-end mt-2 mb-2">Comment</button>
                </div>
                {!! Form::close() !!}
            </div>

           
            @if (isset($comments) && $comments->count() > 0)
                @foreach ($comments as $comment)
                    <div class="mb-1 d-flex">
                        <img class="rounded-circle" src="http://placehold.it/50x50" alt="" height="40"
                            width="40">
                        <div class="media-body m-2">
                            <p class="mt-0"> <strong>{{ $comment->user->name }}</strong><br>
                                <small>{{ $comment->comment }}</small>
                            </p>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-md-12">
                        {{ $comments->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @else
                <div class="media mb-4">
                    <h1>No comments found</h1>
                </div>
            @endif
        </div>
    </div>
@endsection
