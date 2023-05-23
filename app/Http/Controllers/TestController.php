<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{

    public function HomeMain()
    {
        return view('frontend.index');
    }
    public function index()
    {
        return view('about');
    }
    public function show()
    {
        return view('test');
    }
}
