<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PercabanganController extends Controller
{
    public function percabangan()
    {
        return view('percabangan.index');
    }
}
