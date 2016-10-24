<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Song;
use Session;

class SongsController extends ControllersController
{
    protected $dates = ['deleted_at'];

    public function create(Request $request) {
        $song = new Song();
        $song->name = $request->input('name');
        $song->save();

        return back();
    }

    public function index() {
        $songs = Song::all();
        return view('songs', compact('songs'));
    }
    public function show($song_id) {
        $song = Song::find($song_id);
        return view('song', compact('song'));
    }

    public function update(Request $request, $song_id) {
        $song = Song::find($song_id);
        $song->name = $request->input('name');
        $song->save();

        return redirect('/songs');
    }

    public function destroy($song_id) {
        $song = Song::find($song_id);
        $song_name = (string)$song->name;
        $song->delete();

        Session::flash('song_name', $song_name);
        return back();
    }
}
