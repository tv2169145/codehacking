<?php

namespace App\Http\Controllers;

use App\Photo;

use App\Post;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Http\Requests;

class AdminMediasController extends Controller
{
    //

    public function index(){

    	$photos=Photo::all();

    	return view('admin.media.index',compact('photos'));
    }

    public function create(){


    	return view('admin.media.create');
    }

    public function store(Request $request){

    	$file=$request->file('file');

    	$name=time().$file->getClientOriginalName();

    	$file->move('images',$name);

    	Photo::create(['file'=>$name]);

    }

    public function destroy($id){

    	$photo=Photo::findOrFail($id);

    	unlink(public_path().$photo->file);

    	$photo->delete();

    	Session::flash('delete_message','the photo has been deleted');

    	return redirect('/admin/media');

    }

    public function deleteMedia(Request $request){



        // if(isset($request->delete_single)){

        //    // $this->destroy($request->photo);

        //     return $request->all();
        // }

        if(isset($request->delete_all) && !empty($request->checkBoxArray)){

            $photos=Photo::findOrFail($request->checkBoxArray);

            foreach($photos as $photo){

                unlink(public_path().$photo->file);

                $photo->delete();

            }

            
            return redirect()->back();

        }else{

            return redirect()->back();

        }



    }

    public function delete($id){

        $photo=Photo::findOrFail($id);

        $post=Post::where('photo_id',$id)->first();

        if(!empty($post)){

            $post->update(['photo_id'=>'0']);

        }

        

        

        unlink(public_path().$photo->file);

        $photo->delete();

        Session::flash('delete_message','the photo has been deleted');

        return redirect('/admin/media');

    }


}
