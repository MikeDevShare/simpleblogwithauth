@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">   
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Categories</div>
          <input type="hidden" id="base-url" value="{{ url('/') }}">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-6 cat-list">
                <ul>
                  @foreach ($cats as $cat)
                    @if( $cat->id != 1 )
                      <li>
                        <a href="" rel="{{ $cat->id }}">{{ $cat->title }}</a> 
                        <div class="action"> <small><a href="#edit" rel="{{ $cat->id }}">Edit</a> | <a href="#delete" rel="{{ $cat->id }}">Delete</a>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </small>
                        </div>
                      </li>
                    @else
                      <li><a href="" rel="{{ $cat->id }}">{{ $cat->title }}</a></li>
                    @endif
                  @endforeach
                </ul>
                
              </div>
              <div class="col-md-6 cat-edit-form">
                <div class="message"></div>
                <form class="hidden edit-cat" action="{{ url('/')}}/dashboard/categories/edit" method="post">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="cat_id" value="{{ old('cat_id') }}">
                  <div class="form-group">
                    <input required="required" value="{{ old('title') }}" placeholder="Enter category title here" type="text" name = "title"class="form-control" />
                  </div>
                  <div class="form-group">
                    <textarea name='body'class="form-control">{{ old('body') }}</textarea>
                  </div>
                  <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
                </form>
              </div>
            </div>

            <p>
              <a href="javascript:void(0);" id="add-cat">Add Category</a>
            </p>
            <form action="{{ url('/')}}/dashboard/categories/add" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <input required="required" value="{{ old('title') }}" placeholder="Enter category title here" type="text" name = "title"class="form-control" />
              </div>
              <div class="form-group">
                <textarea name='body'class="form-control">{{ old('body') }}</textarea>
              </div>
              <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

