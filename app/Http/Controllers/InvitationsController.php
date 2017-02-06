<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Invitation;
use Illuminate\Http\Request;
use Session;
use App\User;

class InvitationsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store( $active_user, $invited_user)
    {
	    $invitation = new Invitation();
	    $invitation->code = str_random(36);
	    $invitation->active_user_id = $active_user->id;
	    $invitation->user_id = $invited_user->id;
	    $invitation->save();

	    return $invitation;
    }

    public function acceptPage($code, $user_id) {
    	return view('invitations.accept', compact('code','user_id'));
    }

	public function redeemInvitation(Request $request) {

		$user = User::find($request->input('user_id'));
		$pw = bcrypt($request->input('password'));

		 $this->validate($request, [
			 'password' => 'required|min:3|confirmed',
		 ]);

		return "testi";
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Invitation::destroy($id);

        Session::flash('flash_message', 'Invitation deleted!');

        return redirect('invitations');
    }
}
