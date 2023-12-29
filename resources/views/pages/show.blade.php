@extends('front-layout.app')

@section('content')
	<!-- Displaying Comments -->

	@if($post && $post->comments)
	    @foreach($post->comments as $comment)
	        {{ $comment->body }}

	        <!-- Displaying Replies for each Comment -->
	        @if($comment->replies)
	            @foreach($comment->replies as $reply)
	                {{ $reply->body }}
	            @endforeach
	        @endif

	        <!-- Reply Form for each Comment -->
	        <form method="post" action="{{ route('reply.store') }}">
	            @csrf
	            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
	            <textarea name="body" placeholder="Reply to this comment"></textarea>
	            <button type="submit">Reply</button>
	        </form>
	    @endforeach
	@endif

	<!-- Comment Form for the Post -->
	<form method="post" action="{{ route('comment.store') }}">
	    @csrf
	    <input type="hidden" name="blog_id" value="{{ $post->id }}">
	    <textarea name="comment" placeholder="Leave a comment"></textarea>
	    <button type="submit" class="btn btn-primary">Comment</button>
	</form>


	<div class="comments-section">
	    <h2>Comments</h2>

	    <!-- Displaying Comments -->
	    <div class="comment">
	        <div class="comment-user">John Doe</div>
	        <div class="comment-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vel...</div>
	        <!-- Displaying Replies to Comment -->
	        <div class="replies-section">
	            <div class="comment">
	                <div class="comment-user">Jane Smith</div>
	                <div class="comment-body">Replying to John's comment. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
	            </div>
	        </div>
	        <div class="comment-actions">
	            <button class="reply-btn">Reply</button>
	        </div>
	        
	        
	        
	    </div>

	    <!-- Comment Box -->
	    <div class="comment-box">
	        <textarea placeholder="Write a comment"></textarea>
	        <button class="submit-comment-btn">Submit Comment</button>
	    </div>

	    <!-- Reply Form -->
	    <div class="reply-form">
	        <textarea placeholder="Write a reply"></textarea>
	        <button class="submit-reply-btn">Submit Reply</button>
	    </div>
	</div>

@endsection