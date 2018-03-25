<?php

namespace App\Http\Controllers;


class HotelsController extends Controller
{

    public function index()
    {
        return view('hotels.index');
    }

}