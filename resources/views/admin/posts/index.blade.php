@extends('layouts.admin')


@section('content')

	
@if(Session::has('delete_message'))
  <p class="bg-danger">{{session('delete_message')}}</p>

@endif

<h1>posts</h1>

<table class="table table-hover">
    <thead>
      <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>Owner</th>
        <th>Category</th>
        <th>Title</th>
        <th>Body</th>
        <th>Created_at</th>
        <th>Updated_at</th>
      </tr>
    </thead>
    <tbody>

    @foreach($posts as $post)	

      <tr>
         <td>{{$post->id}}</td>
         <td><img height=50 src="{{ $post->photo ? $post->photo->file : '/images/noimg_single.png' }}"></td>
         <td>{{$post->user->name}}</td>
         <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td> 
         <td><a href="{{route('admin.posts.edit',$post->id)}}">{{$post->title}}</a></td>
         <td>{{str_limit($post->body,7)}}</td>
         <td>{{$post->created_at->diffForhumans()}}</td>
         <td>{{$post->updated_at->diffForhumans()}}</td>
      </tr>

	@endforeach


    </tbody>
  </table>


@endsection