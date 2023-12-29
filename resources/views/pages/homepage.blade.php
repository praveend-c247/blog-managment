@extends('front-layout.app')

@section('content')
      <div class="wrapper">
        @foreach($blogList as $key => $value)
          <div class="card" style="border:1px solid black">
            <a href="{{ route('blog-detail',$value->id)}}" class="decoration">
              <div class="card-banner">
                 <p class="category-tag popular">{{$value->tags}}</p>
                  @php
                    $media = json_decode($value->blog_media);
                  @endphp
                  @if(isset($media))
                    <img class="banner-img" src="{{ URL::to('/')}}/{{$media[0]}}" alt=''>
                  @else
                    <img class="banner-img" src="{{ URL::to('/admin/images/')}}/no_images.png" alt=''>
                  @endif
              </div>
              <div class="card-body">
                 <p class="blog-hashtag">
                   @foreach($value->BlogCategories as $cat_key => $cat_value)
                      #{{ $cat_value->Categories['categories_title'] }}
                   @endforeach
                 </p>
                 <h2 class="blog-title">{{$value->title}}</h2>
                 <p class="blog-description">{!! $value->short_description !!}</p>
              </div>
            </a>
          </div>
        @endforeach
      </div>
@endsection
