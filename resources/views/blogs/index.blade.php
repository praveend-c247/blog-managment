@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Blogs List
                    <div class="position-relative">
                        <div class="position-absolute top-0 end-0 translate-middle pb-4">
                            <a href="{{ route('admin.blogs.create')}}" class="btn btn-primary">Add New</a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <table id="" class="display table table-striped" style="width:100%">
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
                            @if(count($blog_list) > 0)
                                @foreach($blog_list as $key=>$value)
                                <tr>
                                    <td>{{ ++$i}}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->tags }}</td>
                                    <td>{{ $value->date }}</td>
                                    <td>
                                        <a href="{{ route('admin.blogs.edit',$value->id) }}" class="btn btn-info d-inline me-2">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        
                                        <a href="javascript::void(0)" class="confirmation-form d-inline btn btn-danger" data-url="{{ route('admin.blogs.destroy',$value->id) }}" data-methodType ="delete"><i class="fa fa-trash"></i></a>

                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" align="center">No Records Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
                {!! $blog_list->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection