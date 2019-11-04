@extends('layouts.admin')

@section('title','Blog Update')

@section('content')
    <div class='container'>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>Blog Update</h2>
                <form action="{{ action('Admin\BlogController@update') }}" method="post" enctype="multipart/form-data">
                    
                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="title">Title</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ $blogs_form->title }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="body">Body</label>
                        <div class="col-md-10">
                            <textarea type="form-control" class="form-control" name="body" rows="20">{{ $blogs_form->body }}</textarea>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="image">Image</label>
                        <div class="col-md-10">
                            
                            <input type="file" class="form-control-file" name="image">
                            
                            <div class="form-text text-info">
                                Now Setting : {{ $blogs_form->image_path }}
                            </div>
                            
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">Remove the image
                                </label>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="form-group-row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $blogs_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                    </div>
                    
                </form>
                
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>Edit History</h2>
                        <ul class="list-group">
                            @if ($blogs_form->histories != NULL)
                                @foreach ($blogs_form->histories as $history)
                                    <li class="list-group-item">{{ $history->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection