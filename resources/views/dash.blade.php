@extends('layouts.app')

@section('content')
<div class="container dash">
    <div class="row">
    	<div class="col-md-10 col-md-offset-1">
    		<div class="panel panel-default">
    			<div class="panel-heading">Dashboard</div>
    			<div class="panel-body">
    				<ul>
    					<li>
                            <a href="{{ url('/dashboard/new-post') }}">Add new post</a>
                        </li>
                        <li>
                            <a href="{{ url('/dashboard/categories') }}">Categories</a>
                        </li>
    				</ul>
    			</div>
    		</div>
    	</div>
    </div>
</div>
@endsection