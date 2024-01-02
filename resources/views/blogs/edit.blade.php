@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Blog
                </div>
                
                <div class="card-body">
                    <form method="POST" id="formValidate" class="" action="{{ route('blogs.update',$blog->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <label for="title" class="">Title</label>
                                
                                <input type="hidden" name="id" value="{{ $blog->id }}">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter Title" value="{{ $blog->title }}" data-rule-required="true" data-msg-required="{{__('validationMessage.title')}}">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="title" class="">Categories</label>
                                @php
                                    $selected = [];
                                @endphp
                                @foreach($blog->Blogcategories as $cat_key => $cat_value)
                                    @php
                                        $selected[] = $cat_value->categories_id;
                                    @endphp
                                @endforeach
                                <select class="form-control @error('categories') is-invalid @enderror js-example-basic-multiple" name="categories[]" multiple="multiple" data-rule-required="true" data-msg-required="{{__('validationMessage.categories')}}">
                                    <option value="">Select Categories</option>
                                    @foreach($categoriesList as $key => $value)
                                        <option value="{{ $value->id }}" {{ (in_array($value->id, $selected)) ? 'selected' : '' }}>{{ $value->categories_title}}</option>
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

                                <textarea name="short_description" rows="4" placeholder="Enter Short Description" class="form-control @error('short_description') is-invalid @enderror" data-rule-required="true" data-msg-required="{{__('validationMessage.short_description')}}">{{ $blog->short_description }}</textarea>

                                @error('short_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="title" class="">Description</label>

                                <textarea name="description" id="editor1" rows="1" placeholder="Enter Description" class="@error('description') is-invalid @enderror" data-rule-required="true" data-msg-required="{{__('validationMessage.description')}}">{{ $blog->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="title" class="">Image</label>

                                <input type="file" name="blog_media[]" class="form-control mb-2" multiple>
                                <input type="hidden" name="old_media" value="{{ $blog->blog_media }}">
                                <div class="mb-13">
                                    @php
                                        $old_media = json_decode($blog->blog_media);
                                    @endphp
                                    @foreach($old_media as $media_key => $media_value)

                                        <img src="{{ URL::to('/')}}/{{$media_value}}" height="50px;" width="50px;" class="mb-13" border="1">
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="title" class="">Tags</label>

                                <input type="text" name="tags" class="form-control @error('tags') is-invalid @enderror" placeholder="Enter Tag" value="{{ $blog->tags }}" data-rule-required="true" data-msg-required="{{__('validationMessage.tags')}}">

                                @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="title" class="">Date </label>

                                <input type="text" name="date" class="form-control @error('date') is-invalid @enderror" id="datepicker" placeholder="Enter Date" value="{{ $blog->date }}" data-rule-required="true" data-msg-required="{{__('validationMessage.date')}}">

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="title" class="">Time </label>

                                <input type="text" name="time" class="form-control @error('time') is-invalid @enderror timepicker" id="timepicker" placeholder="Enter Time" value="{{ $blog->time }}" data-rule-required="true" data-msg-required="{{__('validationMessage.time')}}">

                                @error('time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Update
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