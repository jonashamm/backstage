<?php

namespace App\Http\Controllers;

use App\Cast;

class CastsController extends GlobalController
{
	public function destroy($user_id, $instrument_id) {
		$cast = Cast
			::where('user_id',$user_id)
			->where('instrument_id',$instrument_id);
		$cast->delete();

		return back();
	}
}
