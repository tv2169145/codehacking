<?php

namespace App\Http\Controllers;

use App\Post;

use App\Photo;

use App\Category;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

use App\Http\Requests\PostsCreateRequest;

use App\Http\Requests\PostsEditRequest;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts=Post::all();

        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorys=Category::lists('name','id')->all();


        return view('admin.posts.create',compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //

        $input=$request->all();

        $user=Auth::user();

        

        $input['user_id']=$user->id;

        if($file=$request->file('photo_id')){

            $name=time().$file->getClientOriginalName();

            $file->move('images',$name);

            $photo=Photo::create(['file'=>$name]);

            $input['photo_id']=$photo->id;

        }

        Post::create($input);
        
        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post=Post::findOrFail($id);

        $categorys=Category::lists('name','id')->all();


        return view('admin.posts.edit',compact('post','categorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsEditRequest $request, $id)
    {
        //
        $input=$request->all();

        // $post=Post::findOrFail($id);

        if($file=$request->file('photo_id')){

            $name=time().$file->getClientOriginalName();

            $file->move('images',$name);

            $photo=Photo::create(['file'=>$name]);

            $input['photo_id']=$photo->id;

        }
        else{
            $input['photo_id']='0';

        }

        Auth::user()->posts()->whereId($id)->first()->update($input);


        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post=Auth::user()->posts()->whereId($id)->first();

        if($post->photo){

            unlink(public_path().$post->photo->file);
        }

        $post->delete();

        Session::flash('delete_message','The post has been deleted');

        return redirect('/admin/posts');
               
    }
}
