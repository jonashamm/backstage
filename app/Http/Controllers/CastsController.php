<?php

namespace App\Http\Controllers;

use App\Cast;
use Illuminate\Http\Request;

class CastsController extends Controller
{
	public function destroy($user_id, $instrument_id) {
		$cast = Cast
			::where('user_id',$user_id)
			->where('instrument_id',$instrument_id);
		$cast->delete();

		return back();
	}
}
