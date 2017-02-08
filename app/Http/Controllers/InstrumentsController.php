<?php

namespace App\Http\Controllers;

use App\Instrument;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cast;
use App\Songcast;

class InstrumentsController extends GlobalController
{
    public function index() {
        $instruments = Instrument::all();
        return view('instruments',compact('instruments'));
    }
    public function indexAPI() {
        return Instrument::with('users')->orderBy('name')->get();
    }
    public function store(Request $request) {
        $instrument = new Instrument();
        saverLoop($request,$instrument,['name']);
        $instrument->save();

        return back();
    }
    public function update() {

    }
    public function destroy($instrument_id) {
        $instrument = Instrument::where('id',$instrument_id)->with('songcasts','casts')->first();
        foreach($instrument->songcasts as $songcast) {
	        $songcast->delete();
        }
	    $instrument->casts()->detach();
        $instrument->delete();
        return back();
    }
}
