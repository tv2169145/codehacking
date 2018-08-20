@extends('layouts.blog-home')



@section('content')

               <h1 class="page-header">
                    My blog
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
        @if(count($posts)>0) 

        	@foreach($posts as $post)       

                <h2>
                    <a href="#">{{$post->title}}</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">{{$post->user->name}}</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span>{{$post->created_at->diffForHumans()}}</p>
                @if($post->photo)
                <hr>
                
                	<img class="img-responsive" src="{{$post->photo->file}}" alt="">
                
                <hr>
                @endif	
                <p>{{str_limit($post->body,10)}}</p>
                <a class="btn btn-primary" href="{{route('home.post',$post->slug)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            @endforeach    

        @endif        

                
                
               <div class="row">
				    <div class="col-sm-6 col-sm-offset-5">
				            {{$posts->render()}}
				    </div>   
				</div>  




@endsection






@section('category')

 					<h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                            @if(count($categories)>0)

                            	@foreach($categories as $category)	
                              
                                <li><a href="#">{{$category->name}}</a></li>
                                

                                @endforeach

                                @else
                                	<h3 class="text-center">No Categories</h3>


                            @endif    
                            </ul>
                        </div>
                        
                    </div>


@endsection
