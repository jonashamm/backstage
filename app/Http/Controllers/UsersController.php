<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UsersController extends Controller
{
    public function index() {
        $users = User::all();
        return view('users',compact('users'));
    }

    public function store(Request $request) {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = 'asd';
        $user->save();
        return back();
    }
    public function destroy($id) {
        $user = User::find($id);
        $user->delete();

        return back();
    }
}
