@extends('layouts.admin')



@section('content')

<h1>Create Category</h1>

{!! Form::open(['method'=>'POST','action'=>'AdminCategoriesController@store']) !!}

	<div class="form-group">
		{!! Form::label('name','Name:') !!}
		{!! Form::text('name',null,['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Create',['class'=>'btn btn-info']) !!}	
	</div>

{!! Form::close() !!}

@include('includes.form-errors')


@endsection