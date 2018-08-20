@extends('layouts.blog-post')



@section('content')

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$post->title}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">{{$post->user->name}}</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForhumans()}}</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="{{$post->photo_id !=0 ? $post->photo->file :'/images/noimg_single.png'}}" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead">{{$post->body}}</p>

                <hr>
            @if(Auth::check())
                <!-- Blog Comments -->

                <!-- Comments Form -->
                @if(Session::has('comment_message'))
                	<p class="bg-success">{{session('comment_message')}}</p>
                @endif
                <div class="well">
                    <h4>Leave a Comment:</h4>

                    {!! Form::open(['method'=>'POST','action'=>'PostCommentsController@store']) !!}

                    	<input type="hidden" name="post_id" value="{{$post->id}}">

                    	<div class="form-group">
                    		{!! Form::label('body','Body:') !!}
                    		{!! Form::textarea('body',null,['class'=>'form-control','rows'=>3]) !!}
                    	</div>

                    	<div class="form-group">
                    		{!! Form::submit('Submit Comment',['class'=>'btn btn-primary']) !!}
                    	</div>	
                    {!! Form::close() !!}

                    @include('includes.form-errors')	

                </div>

            @endif    

                <hr>


                @if(Session::has('reply_message'))
                	<p class="bg-success">{{session('reply_message')}}</p>
                @endif


            @if(count($comments)>0)

            	@foreach($comments as $comment)
	                <!-- Posted Comments -->

	                <!-- Comment -->
	                <div class="media">
	                    <a class="pull-left" href="#">
	                        <img height="64" class="media-object" src="{{$comment->user->photo ? $comment->user->photo->file : '/images/no-user-photo.jpg'}}" alt="">
	                    </a>
	                    <div class="media-body">
	                        <h4 class="media-heading">{{$comment->user->name}}
	                            <small>{{$comment->created_at->diffForHumans()}}</small>
	                        
	                        </h4>
	                        <p>{{$comment->body}}</p>


	               
	                      
	                        <!-- Nested Comment -->
                        <div class="media" style="margin-top:25px">


                    @if(count($comment->replies)>0)

                    	@foreach($comment->replies as $reply)
                    		@if($reply->is_active==1)
	                            <a class="pull-left" href="#">
	                                <img height="64" class="media-object" src="{{$reply->user->photo ? $reply->user->photo->file : '/images/no-user-photo.jpg'}}" alt="">
	                            </a>
	                            <div class="media-body">
	                                <h4 class="media-heading">{{$reply->user->name }}
	                                    <small>{{$reply->created_at->diffForHumans()}}</small>
	                                
	                                </h4>
	                                <p>{{$reply->body}}</p>
	                                <br>
	                            </div>

	                        @endif

                        @endforeach    

                    @endif

 			</div>

 		@if(Auth::check())	
 			<div class="comment-reply-container"> 

	           <button class="toggle-reply btn btn-primary pull-right">Reply</button>

	           	<div class="comment-reply col-sm-6">    

          {!! Form::open(['method'=>'POST','action'=>'CommentRepliesController@createReply']) !!}

                    	
                         <input type="hidden" name="comment_id" value="{{$comment->id}}">
                    	<div class="form-group">
                    		{!! Form::label('reply_body','Body:') !!}
                    		{!! Form::textarea('reply_body',null,['class'=>'form-control','rows'=>1]) !!}
                    	</div>

                    	<div class="form-group">
                    		{!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                    	</div>	
           {!! Form::close() !!}

                </div>

            </div>
        @endif    


                        <!-- End Nested Comment -->


	                    </div>
	                </div>

                @endforeach

            @endif    

              
@endsection



         @section('category')  
                   <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                            	@foreach($categorys as $category)

                                	<li><a href="#">{{$category->name}}</a></li>

                                @endforeach
                            </ul>
                        </div>
                       
                    </div>
                    <!-- /.row -->
                </div>




        @endsection

    @section('scripts')
    	
    	<script type="text/javascript">
			
    		$(".comment-reply-container .toggle-reply").click(function(){

    			$(this).next().slideToggle("slow");

    		});

    	</script>

    @endsection    




