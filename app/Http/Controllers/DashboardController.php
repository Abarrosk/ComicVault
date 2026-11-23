<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $utilizador = Auth::user();

        return view('dashboard', compact('utilizador'));
    }
}
