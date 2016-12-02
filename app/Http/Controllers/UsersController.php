<?php

namespace App\Http\Controllers;

use App\Instrument;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UsersController extends Controller
{
    public function index() {
        $users = User::all();
        return view('users',compact('users'));
    }

    public function show($id) {
        $user = User::with('instruments')->find($id);
        $users_instruments = $user->instruments()->pluck('instruments.id');

        $instruments = Instrument::whereNotIn('id',$users_instruments)->get();

        return view('user',compact('user','instruments'));
    }
    public function store(Request $request) {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = 'asd';
        $user->save();

        return back();
    }
    public function update(Request $request, $id) {
        $user = User::find($id);
        $instrument = Instrument::find($request->input('instrument'));

        $already_existing = $user->instruments->contains($instrument->id);
        if (!$already_existing) {
            $user->instruments()->attach([$instrument->id]);
        }

        return back();
    }
    public function destroy($id) {
        $user = User::find($id);
        $user->delete();

        return back();
    }
}
