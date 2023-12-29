@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Blogs List
                    <div class="position-relative">
                        <div class="position-absolute top-0 end-0 translate-middle pb-4">
                            <a href="{{ route('blogs.create')}}" class="btn btn-primary">Add New</a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>SR No.</th>
                                <th>Blog Title</th>
                                <th>Tag</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach($blog_list as $key=>$value)
                            <tr>
                                <td>{{ ++$i}}</td>
                                <td>{{ $value->title }}</td>
                                <td>{{ $value->tags }}</td>
                                <td>{{ $value->date }}</td>
                                <td>
                                    <a href="{{ route('blogs.edit',$value->id) }}" class="btn btn-info d-inline me-2">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    <form method="POST" action="{{ route('blogs.destroy',$value->id) }}" class="d-inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger d-inline"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection