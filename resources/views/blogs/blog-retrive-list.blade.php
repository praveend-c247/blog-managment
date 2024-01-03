@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Blogs Retrive List
                    <div class="position-relative">
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
                                        <a href="javascript::void(0)" class="confirmation-form d-inline btn btn-danger" data-url="{{ route('blogs.restore',$value->id)}}" data-methodType ="restore"><i class="fa fa-undo"></i></a>
                                       
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