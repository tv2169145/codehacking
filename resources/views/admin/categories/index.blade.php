@extends('layouts.admin')


@section('content')

@if(Session::has('delete_message'))

  <p class="bg-danger">{{session('delete_message')}}</p>

@endif

<h1>Categories</h1>

<div class='col-sm-6'>
 	
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


 	
 </div> 




<div class="col-sm-6">
<table class="table table-hover">
    <thead>
      <tr>
        <th>Id</th>
        <th>name</th>
        <th>Created_at</th>
        <th>Updated_at</th>
      </tr>
    </thead>
    <tbody>

    @foreach($categories as $category)	

      <tr>
         <td>{{$category->id}}</td>
         <td><a href="{{route('admin.categories.edit',$category->id)}}">{{$category->name}}</a></td>
         <td>{{$category->created_at ? $category->created_at->diffForhumans() : 'no date'}}</td>
         <td>{{$category->updated_at ? $category->updated_at->diffForhumans() : 'no date'}}</td>
      </tr>

	@endforeach


    </tbody>
  </table>

 </div>
 




@endsection