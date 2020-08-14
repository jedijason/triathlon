<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index(){
        $title = "Triathlon Tracker";
        return view('pages.index')->with('title', $title);
    }

    //
    public function about(){
        $title = "About Page";
        return view('pages.about', compact('title'));
    }



}
