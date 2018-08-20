<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\CommentReply;

use Illuminate\Support\Facades\Session;



use Illuminate\Http\Request;

use App\Http\Requests;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function createReply(Request $request){

        $user=Auth::user();

        $data=[
                'comment_id'=>$request->comment_id,
                'user_id'   =>$user->id,
                'body'      =>$request->reply_body

        ];

        CommentReply::create($data);

        Session::flash('reply_message','the message has been submitted');


        return redirect()->back();

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
        $replies=CommentReply::where('comment_id',$id)->get();

        return view('admin.comments.replies.show',compact('replies'));
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        CommentReply::findOrFail($id)->update($request->all());

        return redirect()->back();
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
        CommentReply::findOrFail($id)->delete();
        
        Session::flash('delete_message','the comment has been deleted');

        return redirect()->back();


    }
}
