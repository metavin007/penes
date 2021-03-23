<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirstPageController extends Controller {

    public function index() {
        if (\Auth::check()) {
            return \Redirect::to('profile');
        } else {
            return view('auth.login');
        }
    }

}
