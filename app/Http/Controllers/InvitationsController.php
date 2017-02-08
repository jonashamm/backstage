<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Invitation;
use Illuminate\Http\Request;
use Session;
use App\User;
use Auth;

class InvitationsController extends Controller {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function store( $active_user, $invited_user ) {
		$invitation                 = new Invitation();
		$invitation->code           = str_random( 36 );
		$invitation->active_user_id = $active_user->id;
		$invitation->user_id        = $invited_user->id;
		$invitation->save();

		return $invitation;
	}

	public function acceptPage( $code, $user_id ) {
		return view( 'invitations.accept', compact( 'code', 'user_id' ) );
	}

	public function redeemInvitation( Request $request ) {

		$user = User::with('invitation')->where('id', $request->input( 'user_id' ))->first();
		$invitation = Invitation::where('code',$request->input('code'))->first();
		$pw = bcrypt( $request->input( 'password' ) );

		$this->validate( $request, [
			'password' => 'required|min:4|confirmed',
		] );

		if($user->invitation->reddemed == 0 && !$user->password && $invitation->code == $request->input('code')) {

			$user->password = $pw;
			$user->save();
			$invitation->redeemed = 1;

			Auth::login($user);

			$request->session()->flash('password_set',true);

			return redirect(url('/'));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function destroy( $id ) {
		Invitation::destroy( $id );

		Session::flash( 'flash_message', 'Invitation deleted!' );

		return redirect( 'invitations' );
	}
}
