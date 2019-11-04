@extends('layouts.admin')

@section('title','Latest Blogs')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Latest Blogs...</h2>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\BlogController@add') }}" role="button" class="btn btn-primary">Create New Blog</a>
            </div>
            
            <div class="col-md-8">
                <form action="{{ action('Admin\BlogController@index') }}" method="get">
                    <div class="form-group row">
                        <div class="col-md-2">Title</div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}" >  
                        </div>
                        
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="Search">
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="list-blogs col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">Title</th>
                                <th width="50%">BODY</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach($posts as $blog)
                                <tr>
                                    <td>{{ $blog->id }}</td>
                                    <td>{{ \Str::limit($blog->title,100) }}</td>
                                    <td>{{ \Str::limit($blog->body,250)}}</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\BlogController@edit', ['id' => $blog->id ]) }}" role="button" class="btn btn-primary">Edit</a>
                                            <a href="{{ action('Admin\BlogController@delete', ['id' => $blog->id ]) }}" role="button" class="btn btn-primary">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection