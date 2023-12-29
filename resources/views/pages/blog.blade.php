@extends('front-layout.app')
@section('content')
	<div class="row">		
		@foreach($blogList as $key => $value)
			<div class="col-md-12 justify-content-center">
				@php
			        $media = json_decode($value->blog_media);
			    @endphp
				<article class="article-recent" style="background-color: #f2f1f1 !important;">
			        <div class="article-recent-main">
			            <h2 class="article-title">{{$value->title}} </h2>
			            <p class="article-body">{!!$value->short_description!!}</p>
			            <a href="{{ route('blog-detail',$value->id)}}" class="article-read-more">CONTINUE READING</a>
			        </div>
			        <div class="article-recent-secondary">
			            @if(isset($media))
				            <img src="{{ URL::to('/')}}/{{$media[0]}}" alt="" class="article-image" width="250px" height="180px" border="1">
				        @else
				            <img class="banner-img" src="{{ URL::to('/admin/images/')}}/no_images.png" alt=''>
				        @endif
			            <p class="article-info">{{$value->date}}  | {{count($value->comments)}} comments </p>
			        </div>
			    </article>
		    </div>
	    @endforeach		
	</div>
@endsection