<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerulanganController extends Controller
{
    public function perulangan()
    {
        return view('perulangan.index');
    }
}
