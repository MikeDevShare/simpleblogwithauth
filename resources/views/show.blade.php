@extends('layouts.app')

@section('content')
<div class="container dash">
    <div class="row">
    	<div class="col-md-10 col-md-offset-1">
    		<div class="panel panel-default">
    			<div class="panel-heading">{{ $post->post_title }}</div>
    			<div class="panel-body">
                    <div class="post-content"> 
                        {{ $post->post_content }}
                    </div>
    			</div>

    		</div>
    	</div>
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Leave a comment</div>
                <div class="panel-body">
                    @if(Auth::guest())
                        <p>Login to Comment</p>
                    @else
                        <form action="{{ url('/') }}/comments/add-comment" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="on_post" value="{{ $post->id }}">
                            <div class="form-group">
                                <textarea name="comment-body" required="required" placeholder="Enter comment here" class="form-control"></textarea>
                            </div>
                            <input type="submit" name='post_comment' class="btn btn-success" value = "Post"/>
                        </form>
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
@endsection