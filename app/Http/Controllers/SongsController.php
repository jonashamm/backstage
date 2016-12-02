<?php

namespace App\Http\Controllers;

use App\Instrument;
use App\Songcast;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Song;
use Illuminate\Support\Facades\DB;
use Session;

class SongsController extends GlobalController
{
    protected $dates = ['deleted_at'];

    public function store(Request $request) {
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
        $users = User::all();
        $instruments = Instrument::with('users')->get();
        $song = Song::with('attachments')
            ->with('songcasts.instrument_user.instrument', 'songcasts.instrument_user.user')
            ->find($song_id);

//        return $song;
        return view('song', compact('song','users','instruments'));
    }
    public function showAPI($song_id) {
        $song = Song::with('attachments')
            ->with('songcasts.instrument_user.instrument', 'songcasts.instrument_user.user')
            ->find($song_id);

        return $song;
    }

    public function update(Request $request, $song_id) {
        $attachmentshandler = new AttachmentsController();
        $song = Song::find($song_id);
        if($request->file('file')) {
            $attachmentshandler->store($request, $song_id);
        }
        $song->name = $request->input('name');
        $song->save();

        return back();
    }

    public function destroy($song_id) {
        $song = Song::find($song_id);
        $song_name = (string)$song->name;
        $song->delete();

        Session::flash('song_name', $song_name);
        return back();
    }

    public function addCast($song_id,$instrument_id,$user_id) {
        $instrument_user = DB::table('instrument_user')
            ->where('instrument_id',$instrument_id)
            ->where('user_id',$user_id)
            ->first();

        $existing_songcast = Songcast::where('song_id',$song_id)->where('instrument_user_id',$instrument_user->id)->first();

        if(empty($existing_songcast)) {
            $songcast = new Songcast();
            $songcast->song_id = $song_id;
            $songcast->instrument_user_id = $instrument_user->id;
            $songcast->save();

            $newSongcast = Songcast::with('instrument_user.instrument', 'instrument_user.user')->find($songcast->id);
            return $newSongcast;
        }


    }
}
