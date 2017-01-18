<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Attachmenttype;
use Illuminate\Http\Request;
use Session;

class AttachmenttypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $attachmenttypes = Attachmenttype::paginate(25);

        return view('attachmenttypes.index', compact('attachmenttypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('attachmenttypes.create');
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
        
        Attachmenttype::create($requestData);

        Session::flash('flash_message', 'Attachmenttype added!');

        return redirect('attachmenttypes');
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
        $attachmenttype = Attachmenttype::findOrFail($id);

        return view('attachmenttypes.show', compact('attachmenttype'));
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
        $attachmenttype = Attachmenttype::findOrFail($id);

        return view('attachmenttypes.edit', compact('attachmenttype'));
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
        
        $attachmenttype = Attachmenttype::findOrFail($id);
        $attachmenttype->update($requestData);

        Session::flash('flash_message', 'Attachmenttype updated!');

        return redirect('attachmenttypes');
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
        Attachmenttype::destroy($id);

        Session::flash('flash_message', 'Attachmenttype deleted!');

        return redirect('attachmenttypes');
    }

    public function indexAPI() {
	    return Attachmenttype::orderBy('name')->get();
    }
}
