@extends('layouts.app')
@section('title', 'Blog List')
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
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($blogs) && $blogs->count() > 0)
                                    @foreach ($blogs as $key => $blog)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}.</td>
                                            <td>{{ $blog->title }}</td>
                                            <td>{{ $blog->user->name }}</td>
                                            <td>{{ Str::limit($blog->details, 40, '...') }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('blogs.edit', $blog->id) }}" title="Edit">Edit</a>
                                                <a class="btn btn-danger btn-sm" href="" title="Delete">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="5"> No record found...</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if (isset($blogs) && $blogs->count() > 0)
                                {{ $blogs->links('pagination::bootstrap-5') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
