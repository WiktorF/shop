<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Hellov2Controller extends Controller
{
    public function show(){
        return view("hello");
    }
}
