@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
            	<div class="panel-heading">Edit Post - {{ $post->post_title }}</div>
            	<div class="panel-body">
					<form action="{{ url('/') }}/dashboard/update" method="post">
					  <input type="hidden" name="_token" value="{{ csrf_token() }}">
					  <input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">
					  <div class="form-group">
					    <input required="required" value="@if(!old('title')){{$post->post_title}}@endif{{ old('title') }}" placeholder="Enter title here" type="text" name = "title"class="form-control" />
					  </div>
					  <div class="form-group">
					    <textarea name='body'class="form-control">@if(!old('body')){{$post->post_content}}@endif{{ old('body') }}</textarea>
					  </div>
					  <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
					  <input type="submit" name='save' class="btn btn-default" value = "Save Draft" />
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection