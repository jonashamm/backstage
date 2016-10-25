<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use View;
use App\User;

class GlobalController extends Controller
{
    protected $currentUser;

    public function __construct()
    {
        $this->middleware('auth');

        $this->currentUser = Auth::user();
        View::share('currentUser', $this->currentUser);
    }
}
