@extends('front-layout.app')
@section('content')
    <article class="">
       <h2 class="article-title">{{ $blogDetail->title}}</h2>
       <p class="article-info">{{$blogDetail->date}} | {{ count($blogDetail->comments) }} comments | 
        @foreach($reactionCounts as $react_key => $react_value)
            {{ $react_value->count }} {{ $react_value->emoji }}
        @endforeach
       </p>
       <p class="article-body">{{$blogDetail->short_description}}</p>
    </article>
    <article class="article-recent">
        @php
            $media = json_decode($blogDetail->blog_media);
        @endphp
        @if(isset($media))
            @foreach($media as $key => $value)
                <div class="article-recent-secondary">
                    <img src="{{ URL::to('/')}}/{{$value}}" alt="" class="article-image rounded" width="200px" height="200px" border="1">
                </div>
            @endforeach  
        @else
            <img class="banner-img" src="{{ URL::to('/admin/images/')}}/no_images.png" alt=''>
        @endif 
    </article>
    <p class="article-body">{!! $blogDetail->description !!}</p>
    <form method="post" action="{{ route('react', ['reactableType' => 'Blogs', 'reactableId' => $blogDetail->id]) }}">
       @csrf
       <!-- Default dropup button -->
       <div class="dropup">
          <button type="button" class="btn  btn-outline-secondary" data-bs-toggle="dropdown" aria-expanded="false">
          Like
          </button>
          <ul class="dropdown-menu">
             <!-- Dropdown menu links -->
             <li>
                <figure>
                    @php
                        $i=0;
                    @endphp
                    @foreach($emojis as $key1 => $emoji)
                        <button type="submit" name="emoji" class="emojiBtn btn btn-outline-light" value="{{ $emoji }}/{{ ++$i }}">{{ $emoji }}</button>
                    @endforeach
                </figure>
             </li>
          </ul>
       </div>
    </form>
    <h2>Comments</h2>
    @if($blogDetail && $blogDetail->comments)
        @foreach($blogDetail->comments as $comment)
        <!-- Displaying Comments -->
        <div class="comment">
           <div class="comment-user">John Doe</div>
           <div class="comment-body">{{ $comment->body }}</div>
           <!-- Displaying Replies to Comment -->
           @if($comment->replies)
           @foreach($comment->replies as $reply)
           <div class="replies-section">
              <div class="comment">
                 <div class="comment-user">Jane Smith</div>
                 <div class="comment-body">{{ $reply->body }}</div>
              </div>
           </div>
           @endforeach
           @endif
           <!-- Reply Form for each Comment -->
           <div class="reply-form replyForm" id="replyForm" style="display:none;">
              <form method="post" action="{{ route('reply.store') }}">
                 @csrf
                 <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                 <textarea name="body" placeholder="Reply to this comment"></textarea>
                 <button type="submit" class="btn btn-primary">Submit</button>
              </form>
           </div>
           <div class="comment-actions">
              <button class="reply-btn replyBtn" id="replyBtn">Reply</button>
           </div>
        </div>
        @endforeach
    @endif
    <!-- Comment Box -->
    <div class="comment-box">
       <form method="post" action="{{ route('comment.store') }}">
          @csrf
          <input type="hidden" name="blog_id" value="{{ $blogDetail->id }}">
          <textarea name="comment" placeholder="Leave a comment" required></textarea>
          <button type="submit" class="submit-comment-btn">Comment</button>
       </form>
    </div>
    <script type="text/javascript">
        $(document).ready(function (ev) {           
            $( ".replyBtn" ).on( "click", function( ev ) {
                $(".replyForm").show();
            })
        });
    </script>
@endsection
