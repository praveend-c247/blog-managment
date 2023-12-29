@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Blog
                </div>
                
                <div class="card-body">
                    <form method="POST" id="bvalidatorForm" class="bvalidatorForm" action="{{ route('blogs.store') }}" data-bvalidator-validate enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="title" class="">Title</label>
                            
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter Title" data-bvalidator="required">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="title" class="">Categories</label>
                                <select class="form-control js-example-basic-multiple @error('categories') is-invalid @enderror" name="categories[]" multiple="multiple">
                                    <option value="">Select Categories</option>
                                    @foreach($categoriesList as $key => $value)
                                        <option value="{{$value->id}}">{{$value->categories_title}}</option>
                                    @endforeach
                                </select>

                                @error('categories')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="title" class="">Short Description</label>

                                <textarea name="short_description" rows="4" placeholder="Enter Short Description" class="form-control @error('short_description') is-invalid @enderror"></textarea>

                                @error('short_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="title" class="">Description</label>

                                <textarea name="description" id="editor1" rows="1" placeholder="Enter Description" class="form-control  @error('description') is-invalid @enderror"></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="title" class="">Image</label>

                                <input type="file" name="blog_media[]" class="form-control @error('blog_media') is-invalid @enderror" multiple>

                                @error('blog_media')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="title" class="">Tags</label>

                                <input type="text" name="tags" class="form-control @error('tags') is-invalid @enderror" placeholder="Enter Tag">

                                @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="title" class="">Date </label>

                                <input type="text" name="date" class="form-control @error('date') is-invalid @enderror" id="datepicker" placeholder="Enter Date">

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="title" class="">Time </label>

                                <input type="text" name="time" class="form-control timepicker @error('time') is-invalid @enderror" id="timepicker" placeholder="Enter Time">

                                @error('time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Save
                                </button>

                                <a href="{{ route('blogs.index')}}" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection