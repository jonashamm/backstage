<?php

namespace App\Http\Controllers;

use App\Instrument;
use Illuminate\Http\Request;
use App\Http\Requests;

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
        $instrument = Instrument::find($instrument_id);
	    $instrument->user()->detach();
        $instrument->delete();
        return back();
    }
}
