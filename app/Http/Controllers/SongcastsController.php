<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Songcast;
use Illuminate\Http\Request;
use Session;

class SongcastsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $songcasts = Songcast::paginate(25);

        return view('songcasts.index', compact('songcasts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('songcasts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Songcast::create($requestData);

        Session::flash('flash_message', 'Songcast added!');

        return redirect('songcasts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $songcast = Songcast::findOrFail($id);

        return view('songcasts.show', compact('songcast'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $songcast = Songcast::findOrFail($id);
        return view('songcasts.edit', compact('songcast'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $songcast = Songcast::findOrFail($id);
        $songcast->update($requestData);

        Session::flash('flash_message', 'Songcast updated!');

        return redirect('songcasts');
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
        Songcast::destroy($id);

        Session::flash('flash_message', 'Songcast deleted!');

        return redirect('songcasts');
    }
}
