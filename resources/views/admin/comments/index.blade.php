@extends('layouts.admin')


@section('content')

@if(Session::has('delete_message'))
	<p class="bg-danger">{{session('delete_message')}}</p>

@endif

<h1>Comments</h1>

@if(count($comments)>0)

		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Id</th>
		        <th>Author</th>
		        <th>Email</th>
		        <th>Body</th>
		        <th>Post Link</th>
		        <th>replies</th>
		        <th>Approve</th>
		        <th>Delete</th>
		        
		      </tr>
		    </thead>
		    <tbody>
		    @foreach($comments as $comment)	
		     
		      <tr>
		        <td>{{$comment->id}}</td>
		        <td>{{$comment->user->name }}</td>
		        <td>{{$comment->user->email}}</td>
		        <td>{{str_limit($comment->body,10)}}</td>
		        <td><a href="{{route('home.post',$comment->post->slug)}}">view post</a></td>
		        <td><a href="{{route('admin.comment.replies.show',$comment->id)}}">view replies</a></td>
		        <td>
		        	@if($comment->is_active == 1)

			        		{!! Form::open(['method'=>'PATCH','action'=>['PostCommentsController@update',$comment->id]]) !!}

			        		<input type="hidden" name="is_active" value="0">

			        		<div class="form-group">
			        			{!! Form::submit('Not Active',['class'=>'btn btn-warning']) !!}
			        		</div>

			        		{!! Form::close() !!}

		        		@else
		        			{!! Form::open(['method'=>'PATCH','action'=>['PostCommentsController@update',$comment->id]]) !!}

			        		<input type="hidden" name="is_active" value="1">

			        		<div class="form-group">
			        			{!! Form::submit('Active',['class'=>'btn btn-primary']) !!}
			        		</div>

			        		{!! Form::close() !!}

		        	@endif
		        </td>

		        <td>
		        	{!! Form::open(['method'=>'DELETE','action'=>['PostCommentsController@destroy',$comment->id]]) !!}
			        		<div class="form-group">
			        			{!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
			        		</div>

			        {!! Form::close() !!}
		        </td>

		      </tr>

		    @endforeach  
		    </tbody>
		  </table>

	  @else
	  	<h1 class="text-center">No Comments!</h1>



@endif


@endsection