@extends('layouts.admin')


@section('content')

<h1>posts</h1>

<table class="table table-hover">
    <thead>
      <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>Owner</th>
        <th>Category_id</th>
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
         <td>{{$post->category_id}}</td> 
         <td>{{$post->title}}</td>
         <td>{{$post->body}}</td>
         <td>{{$post->created_at->diffForhumans()}}</td>
         <td>{{$post->updated_at->diffForhumans()}}</td>
      </tr>

	@endforeach


    </tbody>
  </table>


@endsection