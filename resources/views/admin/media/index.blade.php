@extends('layouts.admin')


@section('content')

@if(Session::has('delete_message'))
    
  <p class="btn-danger">{{session('delete_message')}}</p>

@endif


<h1>Media</h1>

@if($photos)

  <form method="POST"  action="delete/media" class="form-inline">
    {{csrf_field()}}
    {{method_field('delete')}}

    <div class="form-group">
      <select name="checkBoxArray" class="form-control">

        <option value="">Delete</option>

      </select>
    </div>

    <div class="form-group">

      <input type="submit" name="delete_all" class="btn btn-primary" value="刪除">
    </div>


 <table class="table table-hover">
    <thead>
      <tr>
        <th><input type="checkbox" id="options"></th>
        <th>Id</th>
        <th>Name</th>
        <th>Created</th>
        <th>Delete</th>
      </tr>
    </thead>

    <tbody>
    @foreach($photos as $photo)	

      <tr>
        <td>
          <input class="checkBoxes " type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}">
        </td>

        <td>{{$photo->id}}</td>
        <td><img height=50 src="{{$photo->file}}"></td>
        <td>{{$photo->created_at ? $photo->created_at : 'no date'}}</td>
        <td>
         <!-- <input type="hidden" name="photo" value="{{$photo->id}}">
          <div class="form-group">

            <input type="submit" name="delete_single" value="Delete" class="btn btn-danger">

 
          </div> -->
          <a  class="btn btn-danger" href="{{route('delete.media',$photo->id)}}">Delete this photo</a>

        </td>
      </tr>

     @endforeach 

    </tbody>
  </table>

  </form>

@endif




@endsection

@section('scripts')

<script type="text/javascript">
  
  $(document).ready(function(){

    $("#options").click(function(){

      if(this.checked){

        $(".checkBoxes").each(function(){


          this.checked=true;
        });

      }else{
        $(".checkBoxes").each(function(){

          this.checked=false;
        });

      }

    });

  });


</script>



@endsection