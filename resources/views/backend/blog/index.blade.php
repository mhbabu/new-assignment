@extends('layouts.app')
@section('title', 'Blog List')
@section('header-css')
    {!! Html::style('css/dataTables.bootstrap4.min.css') !!}
    {!! Html::style('css/buttons.dataTables.min.css') !!}
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5> {{ __('Blogs List') }}</h5>
                <a class="btn btn-primary btn-sm text-end" title="Create New" href="{{ route('blogs.create') }}">Create</a>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-script')
    {!! Html::script('js/jquery.dataTables.min.js') !!}
    {!! Html::script('js/dataTables.bootstrap4.min.js') !!}
    {!! Html::script('js/dataTables.buttons.min.js') !!}
    {!! Html::script('js/buttons.server-side.js') !!}

    @if(isset($dataTable))
    {!! $dataTable->scripts() !!}
    @endif

@endsection
