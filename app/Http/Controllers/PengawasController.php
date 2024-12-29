<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengawasController extends Controller
{
    public function index()
    {
        return view('pengawas.dashboard');
    }
}
