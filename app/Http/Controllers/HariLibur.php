<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HariLibur extends Controller
{
    public function index() {
        return view('libur.hariLibur');
    }

    public function create() {
        return view('libur.createHariLibur');
    }
}
