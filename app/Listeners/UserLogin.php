<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Http\Request;
use Auth;

class UserLogin
{
    protected $request;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        //
        $this->request=$request;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        //
        $user=Auth::user();
        $user->last_ip=$this->request->ip();
        $user->save();

    }
}
