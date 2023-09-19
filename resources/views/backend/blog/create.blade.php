@extends('layouts.app')
@section('title', 'Create Blog')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5> {{ __('Create Blog') }}</h5>
            </div>

            <form method="POST" action="{{ route('blogs.store') }}">
                @csrf
                <div class="card-body">

                    <div class="row mb-3">
                        <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="deteails" class="col-md-4 col-form-label text-md-end">{{ __('Details') }}</label>
                        <div class="col-md-6">
                            <textarea id="details" class="form-control @error('details') is-invalid @enderror" name="details"
                                value="{{ old('details') }}" required autocomplete="details" rows="5" autofocus></textarea>
                            @error('details')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row mb-0">
                        <div class="col-md-6 text-start">
                            <a href="{{ route('blogs.index') }}" class="btn btn-secondary btn-sm"> {{ __('Back') }} </a>
                        </div>
                        <div class="col-md-6 text-end">
                            <button type="submit" class="btn btn-primary btn-sm"> {{ __('Save') }} </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
