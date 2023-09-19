@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5> {{ __('Update Blog') }}</h5>
            </div>

            {!! Form::open(['route' => ['blogs.update', $blog->id], 'method'=>'PATCh']) !!}
                <div class="card-body">

                    <div class="row mb-3">
                        {!! Form::label('title',__('Title'),['class' => 'col-md-4 col-form-label text-md-end']) !!}
                        <div class="col-md-6">
                            {!! Form::text('title', $blog->title, ['class'=>'form-control '.($errors->has('title') ? 'is-invalid' : ''),'required' => true, 'autofocus' => true]) !!}
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        {!! Form::label('details',__('Details'),['class' => 'col-md-4 col-form-label text-md-end']) !!}
                        <div class="col-md-6">
                            {!! Form::textarea('details', $blog->details, ['class'=>'form-control '.($errors->has('details') ? 'is-invalid' : ''),'required' => true, 'autofocus' => true, 'rows' => 5]) !!}
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
                            <button type="submit" class="btn btn-primary btn-sm"> {{ __('Update') }} </button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
