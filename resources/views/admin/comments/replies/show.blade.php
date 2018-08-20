@extends('layouts.admin')


@section('content')

@if(Session::has('delete_message'))
	<p class="bg-danger">{{session('delete_message')}}</p>

@endif

<h1>replies</h1>

@if(count($replies)>0)

		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Id</th>
		        <th>Author</th>
		        <th>Email</th>
		        <th>Body</th>
		        <th>Post</th>
		        <th>Approve</th>
		        <th>Delete</th>
		        
		      </tr>
		    </thead>
		    <tbody>
		    @foreach($replies as $reply)	
		     
		      <tr>
		        <td>{{$reply->id}}</td>
		        <td>{{$reply->user->name }}</td>
		        <td>{{$reply->user->email}}</td>
		        <td>{{str_limit($reply->body,10)}}</td>
		        <td><a href="{{route('home.post',$reply->comment->post->id)}}">view post</a></td>
		        <td>
		        	@if($reply->is_active == 1)

			        		{!! Form::open(['method'=>'PATCH','action'=>['CommentRepliesController@update',$reply->id]]) !!}

			        		<input type="hidden" name="is_active" value="0">

			        		<div class="form-group">
			        			{!! Form::submit('Not Active',['class'=>'btn btn-warning']) !!}
			        		</div>

			        		{!! Form::close() !!}

		        		@else
		        			{!! Form::open(['method'=>'PATCH','action'=>['CommentRepliesController@update',$reply->id]]) !!}

			        		<input type="hidden" name="is_active" value="1">

			        		<div class="form-group">
			        			{!! Form::submit('Active',['class'=>'btn btn-primary']) !!}
			        		</div>

			        		{!! Form::close() !!}

		        	@endif
		        </td>

		        <td>
		        	{!! Form::open(['method'=>'DELETE','action'=>['CommentRepliesController@destroy',$reply->id]]) !!}
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
	  	<h1 class="text-center">No replies!</h1>



@endif


@endsection